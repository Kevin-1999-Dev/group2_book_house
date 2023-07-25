<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Exports\BookExport;
use App\Exports\FeedExport;
use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Exports\EbookExport;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Exports\AuthorExport;
use App\Imports\AuthorImport;
use App\Exports\PaymentExport;
use App\Imports\PaymentImport;
use Illuminate\Support\Carbon;
use App\Exports\CategoryExport;
use App\Imports\CategoryImport;
use App\Http\Requests\BookRequest;
use App\Http\Requests\EbookRequest;
use App\Http\Requests\AuthorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PasswordRequest;
use App\Contracts\Services\AdminServiceInterface;

class AdminController extends Controller
{
    public function adminDash()
    {
        // Get dates
        $startDateUser = Carbon::now()->startOfYear();
        $endDateUser = Carbon::now()->endOfYear();
        // Retrieve monthly user count
        $monthlyUsers = User::selectRaw('MONTH(created_at) AS month, COUNT(*) AS countUser')
            ->whereBetween('created_at', [$startDateUser, $endDateUser])
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        // to store in array
        $dataUser = [];
        // Format months name and 0 value
        for ($i = 1; $i <= 12; $i++) {
            $dataUser[Carbon::create()->month($i)->format('F')] = 0;
        }
        // Store months and count in array
        foreach ($monthlyUsers as $user) {
            $monthUser = $user->month;
            $countUser = $user->countUser;
            $dataUser[Carbon::create()->month($monthUser)->format('F')] = $countUser;
        }
        // Separate the months and counts
        $monthsUser = array_keys($dataUser);
        $countsUser = array_values($dataUser);
        ////////////////////////////////////

        // Get dates
        $startDateOrder = Carbon::now()->startOfMonth();
        $endDateOrder = Carbon::now()->endOfMonth();
        // Retrieve monthly ordercount
        $monthlyOrders = Order::selectRaw('DATE(created_at) AS dateOrder, COUNT(*) AS countOrder')
            ->whereBetween('created_at', [$startDateOrder, $endDateOrder])
            ->groupBy('dateOrder')
            ->orderBy('dateOrder')
            ->get();
        // to store in array
        $dataOrder = [];
        // Generate an array with date and format, 0 value
        $currentDateOrder = $startDateOrder;
        while ($currentDateOrder <= $endDateOrder) {
            $formattedDateOrder = $currentDateOrder->format('m-d-Y');
            $dataOrder[$formattedDateOrder] = 0;
            $currentDateOrder->addDay();
        }
        // Store date and count in array
        foreach ($monthlyOrders as $order) {
            $dateOrder = Carbon::parse($order->dateOrder)->format('m-d-Y');
            $countOrder = $order->countOrder;
            $dataOrder[$dateOrder] = $countOrder;
        }
        // Separate the dates and counts to display in the graph
        $datesOrder = array_keys($dataOrder);
        $countsOrder = array_values($dataOrder);

        return view('admin.dashboard', compact('monthsUser', 'datesOrder', 'countsUser', 'countsOrder'));
    }
    //export
    public function exportCategory()
    {
        return Excel::download(new CategoryExport(), 'categories.xlsx');
    }
    public function exportAuthor()
    {
        return Excel::download(new AuthorExport(), 'author.xlsx');
    }
    public function exportPayment()
    {
        return Excel::download(new PaymentExport(), 'payment.xlsx');
    }
    public function exportFeed()
    {
        return Excel::download(new FeedExport(), 'feedback.xlsx');
    }
    public function exportOrder()
    {
        return Excel::download(new OrderExport(), 'order.xlsx');
    }
    public function exportUser()
    {
        return Excel::download(new UserExport(), 'user.xlsx');
    }
    public function exportBook()
    {
        return Excel::download(new BookExport(), 'books.xlsx');
    }
    public function exportEbook()
    {
        return Excel::download(new EbookExport(), 'ebooks.xlsx');
    }

    //import
    public function importCategory(Request $request)
    {
        Excel::import(new CategoryImport, $request->file);
        return redirect()->route('admin.category.index')->with(['importSuccess' => 'Import Successfully...']);
    }
    public function importAuthor(Request $request)
    {

        Excel::import(new AuthorImport, $request->file);
        return redirect()->route('admin.author.index')->with(['importSuccess' => 'Import Successfully...']);
    }
    public function importPayment(Request $request)
    {

        Excel::import(new PaymentImport, $request->file);
        return redirect()->route('admin.payment.index')->with(['importSuccess' => 'Import Successfully...']);
    }
    public function importUser(Request $request)
    {

        Excel::import(new UserImport, $request->file);
        return redirect()->route('admin.user.index')->with(['importSuccess' => 'Import Successfully...']);
    }

    private $adminService;

    public function __construct(AdminServiceInterface $adminServiceInterface)
    {
        $this->adminService = $adminServiceInterface;
    }
    public function changePasswordPage()
    {
        return view('admin.profile.change');
    }
    public function profilePage(){
        return view('admin.profile.details');
    }
    public function editPage(){
        return view('admin.profile.edit');
    }
    public function changePassword(PasswordRequest $request,$id)
    {
        $user = User::select('password')->where('id', $id)->first();
        $dbPassword = $user->password;
        $userOldPassword = $request->oldPassword;

        if (Hash::check($userOldPassword, $dbPassword)) {
            User::where('id', $id)->update([
                'password' => Hash::make($request->newPassword),
            ]);
            Auth::logout();
            return redirect()->route('auth.loginPage')->with(['successPwChange'=>'Successfully Change Password...']);
        }else{
            return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);
        }

    }
    public function updateAdmin(ProfileRequest $request,int $id){
        $this->adminService->adminProfile($request,$id);
        return redirect()->route('admin.details');
    }

    public function categoryIndex(Request $r)
    {
        $categories = $this->adminService->getCategories($r);
        return view('admin.category.index', compact('categories'));
    }


    public function categoryCreate()
    {
        return view('admin.category.create');
    }

    public function categoryStore(CategoryRequest $r)
    {
        $this->adminService->createCategory($r->only([
            'name',
        ]));
        return redirect()->route('admin.category.index');
    }

    public function categoryEdit(int $id)
    {
        $category = $this->adminService->getCategoryById($id);
        return view('admin.category.edit', compact('category'));
    }

    public function categoryUpdate(CategoryRequest $r, int $id)
    {
        $this->adminService->updateCategory($r->only([
            'name',
        ]), $id);
        return redirect()->route('admin.category.index');
    }

    public function categoryDelete(int $id)
    {
        $this->adminService->deleteCategoryById($id);
        return redirect()->route('admin.category.index');
    }

    public function authorIndex(Request $r)
    {
        $authors = $this->adminService->getAuthors($r);
        return view('admin.author.index', compact('authors'));
    }

    public function authorCreate()
    {
        return view('admin.author.create');
    }

    public function authorStore(AuthorRequest $r)
    {
        $this->adminService->createAuthor($r->only([
            'name',
        ]));
        return redirect()->route('admin.author.index');
    }

    public function authorEdit(int $id)
    {
        $author = $this->adminService->getAuthorById($id);
        return view('admin.author.edit', compact('author'));
    }

    public function authorUpdate(AuthorRequest $r, int $id)
    {
        $this->adminService->updateAuthor($r->only([
            'name',
        ]), $id);
        return redirect()->route('admin.author.index');
    }

    public function authorDelete(int $id)
    {
        $this->adminService->deleteAuthorById($id);
        return redirect()->route('admin.author.index');
    }

    public function paymentIndex(Request $r)
    {
        $payments = $this->adminService->getPayments($r);
        return view('admin.payment.index', compact('payments'));
    }

    public function paymentCreate()
    {
        return view('admin.payment.create');
    }

    public function paymentStore(PaymentRequest $r)
    {
        $this->adminService->createPayment($r->only([
            'name',
        ]));
        return redirect()->route('admin.payment.index');
    }

    public function paymentEdit(int $id)
    {
        $payment = $this->adminService->getPaymentById($id);
        return view('admin.payment.edit', compact('payment'));
    }

    public function paymentUpdate(PaymentRequest $r, int $id)
    {
        $this->adminService->updatePayment($r->only([
            'name',
        ]), $id);
        return redirect()->route('admin.payment.index');
    }

    public function paymentDelete(int $id)
    {
        $this->adminService->deletePaymentById($id);
        return redirect()->route('admin.payment.index');
    }

    public function orderIndex(Request $r)
    {
        $orders = $this->adminService->getOrders($r);
        return view('admin.order.index', compact('orders'));
    }

    public function orderDetail(int $id)
    {
        $order = $this->adminService->getOrderById($id);
        return view('admin.order.detail', compact('order'));
    }

    public function orderUpdate(Request $r, int $id)
    {
        $this->adminService->updateOrder($r->only([
            'status',
        ]), $id);
        return redirect()->route('admin.order.index');
    }

    public function bookIndex(Request $r)
    {
        $books = $this->adminService->getBooks($r);
        return view('admin.book.index', compact('books'));
    }

    public function bookCreate(Request $r)
    {
        $categories = $this->adminService->getCategories($r);
        $authors = $this->adminService->getAuthors($r);
        return view('admin.book.create', compact(['categories', 'authors']));
    }

    public function bookStore(BookRequest $r)
    {
        $this->adminService->createBook($r);
        return redirect()->route('admin.book.index');
    }

    public function bookEdit(Request $r, int $id)
    {
        $book = $this->adminService->getBookById($id);
        $categories = $this->adminService->getCategories($r);
        $authors = $this->adminService->getAuthors($r);
        return view('admin.book.edit', compact(['categories', 'authors', 'book']));
    }

    public function bookUpdate(BookRequest $r, int $id)
    {
        $this->adminService->updateBook($r, $id);
        return redirect()->route('admin.book.index');
    }

    public function bookDelete(int $id)
    {
        $this->adminService->deleteBookById($id);
        return redirect()->route('admin.book.index');
    }

    public function getCategoryByBookId(int $id)
    {
        echo Book::findOrFail($id)->category[0]->name;
    }

    public function ebookIndex(Request $r)
    {
        $ebooks = $this->adminService->getEbooks($r);
        return view('admin.ebook.index', compact('ebooks'));
    }

    public function ebookCreate(Request $r)
    {
        $categories = $this->adminService->getCategories($r);
        $authors = $this->adminService->getAuthors($r);
        return view('admin.ebook.create', compact(['categories', 'authors']));
    }

    public function ebookStore(EbookRequest $r)
    {
        $this->adminService->createEbook($r);
        return redirect()->route('admin.ebook.index');
    }

    public function ebookEdit(Request $r,int $id)
    {
        $ebook = $this->adminService->getEbookById($id);
        $categories = $this->adminService->getCategories($r);
        $authors = $this->adminService->getAuthors($r);
        return view('admin.ebook.edit', compact(['categories', 'authors', 'ebook']));
    }

    public function ebookUpdate(EbookRequest $r, int $id)
    {
        $this->adminService->updateEbook($r, $id);
        return redirect()->route('admin.ebook.index');
    }

    public function ebookDelete(int $id)
    {
        $this->adminService->deleteEbookById($id);
        return redirect()->route('admin.ebook.index');
    }

    public function userIndex(Request $r)
    {
        $users = $this->adminService->getUsers($r);
        return view('admin.user.index', compact('users'));
    }

    public function userEdit(int $id)
    {
        $user = $this->adminService->getUserById($id);
        return view('admin.user.edit', compact('user'));
    }

    public function userUpdate(Request $r, int $id)
    {
        $this->adminService->updateUser($r->only([
            'role',
            'active',
        ]), $id);
        return redirect()->route('admin.user.index');
    }

    public function userDelete(int $id)
    {
        $this->adminService->deleteUser($id);
        return redirect()->route('admin.user.index');
    }

    public function feedbackIndex(Request $r)
    {
        $feedbacks = $this->adminService->getFeedback($r);
        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function feedbackDetail(int $id)
    {
        return $this->adminService->getFeedbackById($id);
    }

    public function feedbackDelete(int $id)
    {
        $this->adminService->deleteFeedback($id);
        return redirect()->route('admin.feedback.index');
    }
}
