<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Exports\BookExport;
use App\Exports\FeedExport;
use App\Exports\UserExport;
use App\Exports\EbookExport;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Exports\AuthorExport;
use App\Exports\PaymentExport;
use Illuminate\Support\Carbon;
use App\Exports\CategoryExport;
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

/**
 * AdminController
 */
class AdminController extends Controller
{
    /**
     * adminDash
     *
     * @return void
     */
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
    /**
     * exportCategory
     *
     * @return void
     */
    public function exportCategory()
    {
        return Excel::download(new CategoryExport(), 'categories.xlsx');
    }

    /**
     * exportAuthor
     *
     * @return void
     */
    public function exportAuthor()
    {
        return Excel::download(new AuthorExport(), 'author.xlsx');
    }

    /**
     * exportPayment
     *
     * @return void
     */
    public function exportPayment()
    {
        return Excel::download(new PaymentExport(), 'payment.xlsx');
    }

    /**
     * exportFeed
     *
     * @return void
     */
    public function exportFeed()
    {
        return Excel::download(new FeedExport(), 'feedback.xlsx');
    }

    /**
     * exportOrder
     *
     * @return void
     */
    public function exportOrder()
    {
        return Excel::download(new OrderExport(), 'order.xlsx');
    }

    /**
     * exportUser
     *
     * @return void
     */
    public function exportUser()
    {
        return Excel::download(new UserExport(), 'user.xlsx');
    }

    /**
     * exportBook
     *
     * @return void
     */
    public function exportBook()
    {
        return Excel::download(new BookExport(), 'books.xlsx');
    }

    /**
     * exportEbook
     *
     * @return void
     */
    public function exportEbook()
    {
        return Excel::download(new EbookExport(), 'ebooks.xlsx');
    }

    private $adminService;

    /**
     * __construct
     *
     * @param  mixed $adminServiceInterface
     * @return void
     */
    public function __construct(AdminServiceInterface $adminServiceInterface)
    {
        $this->adminService = $adminServiceInterface;
    }

    /**
     * changePasswordPage
     *
     * @return void
     */
    public function changePasswordPage()
    {
        return view('admin.profile.change');
    }

    /**
     * profilePage
     *
     * @return void
     */
    public function profilePage()
    {
        return view('admin.profile.details');
    }

    /**
     * editPage
     *
     * @return void
     */
    public function editPage()
    {
        return view('admin.profile.edit');
    }

    /**
     * changePassword
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function changePassword(PasswordRequest $request, $id)
    {
        $user = User::select('password')->where('id', $id)->first();
        $dbPassword = $user->password;
        $userOldPassword = $request->oldPassword;

        if (Hash::check($userOldPassword, $dbPassword)) {
            User::where('id', $id)->update([
                'password' => Hash::make($request->newPassword),
            ]);
            Auth::logout();
            return redirect()->route('auth.loginPage')->with(['successPwChange' => 'Successfully Change Password...']);
        } else {
            return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);
        }
    }

    /**
     * updateAdmin
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updateAdmin(ProfileRequest $request, int $id)
    {
        $this->adminService->adminProfile($request, $id);
        return redirect()->route('admin.details');
    }

    /**
     * categoryIndex
     *
     * @param  mixed $r
     * @return void
     */
    public function categoryIndex(Request $r)
    {
        $categories = $this->adminService->getCategories($r);
        return view('admin.category.index', compact('categories'));
    }


    /**
     * categoryCreate
     *
     * @return void
     */
    public function categoryCreate()
    {
        return view('admin.category.create');
    }

    /**
     * categoryStore
     *
     * @param  mixed $r
     * @return void
     */
    public function categoryStore(CategoryRequest $r)
    {
        $this->adminService->createCategory($r->only([
            'name',
        ]));
        return redirect()->route('admin.category.index');
    }

    /**
     * categoryEdit
     *
     * @param  mixed $id
     * @return void
     */
    public function categoryEdit(int $id)
    {
        $category = $this->adminService->getCategoryById($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * categoryUpdate
     *
     * @param  mixed $r
     * @param  mixed $id
     * @return void
     */
    public function categoryUpdate(CategoryRequest $r, int $id)
    {
        $this->adminService->updateCategory($r->only([
            'name',
        ]), $id);
        return redirect()->route('admin.category.index');
    }

    /**
     * categoryDelete
     *
     * @param  mixed $id
     * @return void
     */
    public function categoryDelete(int $id)
    {
        $this->adminService->deleteCategoryById($id);
        return redirect()->route('admin.category.index');
    }

    /**
     * authorIndex
     *
     * @param  mixed $r
     * @return void
     */
    public function authorIndex(Request $r)
    {
        $authors = $this->adminService->getAuthors($r);
        return view('admin.author.index', compact('authors'));
    }

    /**
     * authorCreate
     *
     * @return void
     */
    public function authorCreate()
    {
        return view('admin.author.create');
    }

    /**
     * authorStore
     *
     * @param  mixed $r
     * @return void
     */
    public function authorStore(AuthorRequest $r)
    {
        $this->adminService->createAuthor($r->only([
            'name',
        ]));
        return redirect()->route('admin.author.index');
    }

    /**
     * authorEdit
     *
     * @param  mixed $id
     * @return void
     */
    public function authorEdit(int $id)
    {
        $author = $this->adminService->getAuthorById($id);
        return view('admin.author.edit', compact('author'));
    }

    /**
     * authorUpdate
     *
     * @param  mixed $r
     * @param  mixed $id
     * @return void
     */
    public function authorUpdate(AuthorRequest $r, int $id)
    {
        $this->adminService->updateAuthor($r->only([
            'name',
        ]), $id);
        return redirect()->route('admin.author.index');
    }

    /**
     * authorDelete
     *
     * @param  mixed $id
     * @return void
     */
    public function authorDelete(int $id)
    {
        $this->adminService->deleteAuthorById($id);
        return redirect()->route('admin.author.index');
    }

    /**
     * paymentIndex
     *
     * @param  mixed $r
     * @return void
     */
    public function paymentIndex(Request $r)
    {
        $payments = $this->adminService->getPayments($r);
        return view('admin.payment.index', compact('payments'));
    }

    /**
     * paymentCreate
     *
     * @return void
     */
    public function paymentCreate()
    {
        return view('admin.payment.create');
    }

    /**
     * paymentStore
     *
     * @param  mixed $r
     * @return void
     */
    public function paymentStore(PaymentRequest $r)
    {
        $this->adminService->createPayment($r->only([
            'name',
        ]));
        return redirect()->route('admin.payment.index');
    }

    /**
     * paymentEdit
     *
     * @param  mixed $id
     * @return void
     */
    public function paymentEdit(int $id)
    {
        $payment = $this->adminService->getPaymentById($id);
        return view('admin.payment.edit', compact('payment'));
    }

    /**
     * paymentUpdate
     *
     * @param  mixed $r
     * @param  mixed $id
     * @return void
     */
    public function paymentUpdate(PaymentRequest $r, int $id)
    {
        $this->adminService->updatePayment($r->only([
            'name',
        ]), $id);
        return redirect()->route('admin.payment.index');
    }

    /**
     * paymentDelete
     *
     * @param  mixed $id
     * @return void
     */
    public function paymentDelete(int $id)
    {
        $this->adminService->deletePaymentById($id);
        return redirect()->route('admin.payment.index');
    }

    /**
     * orderIndex
     *
     * @param  mixed $r
     * @return void
     */
    public function orderIndex(Request $r)
    {
        $orders = $this->adminService->getOrders($r);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * orderDetail
     *
     * @param  mixed $id
     * @return void
     */
    public function orderDetail(int $id)
    {
        $order = $this->adminService->getOrderById($id);
        return view('admin.order.detail', compact('order'));
    }

    /**
     * orderUpdate
     *
     * @param  mixed $r
     * @param  mixed $id
     * @return void
     */
    public function orderUpdate(Request $r, int $id)
    {
        $this->adminService->updateOrder($r->only([
            'status',
        ]), $id);
        return redirect()->route('admin.order.index');
    }

    /**
     * bookIndex
     *
     * @param  mixed $r
     * @return void
     */
    public function bookIndex(Request $r)
    {
        $books = $this->adminService->getBooks($r);
        return view('admin.book.index', compact('books'));
    }

    /**
     * bookCreate
     *
     * @param  mixed $r
     * @return void
     */
    public function bookCreate(Request $r)
    {
        $categories = $this->adminService->getCategories($r);
        $authors = $this->adminService->getAuthors($r);
        return view('admin.book.create', compact(['categories', 'authors']));
    }

    /**
     * bookStore
     *
     * @param  mixed $r
     * @return void
     */
    public function bookStore(BookRequest $r)
    {
        $this->adminService->createBook($r);
        return redirect()->route('admin.book.index');
    }

    /**
     * bookEdit
     *
     * @param  mixed $r
     * @param  mixed $id
     * @return void
     */
    public function bookEdit(Request $r, int $id)
    {
        $book = $this->adminService->getBookById($id);
        $categories = $this->adminService->getCategories($r);
        $authors = $this->adminService->getAuthors($r);
        return view('admin.book.edit', compact(['categories', 'authors', 'book']));
    }

    /**
     * bookUpdate
     *
     * @param  mixed $r
     * @param  mixed $id
     * @return void
     */
    public function bookUpdate(BookRequest $r, int $id)
    {
        $this->adminService->updateBook($r, $id);
        return redirect()->route('admin.book.index');
    }

    /**
     * bookDelete
     *
     * @param  mixed $id
     * @return void
     */
    public function bookDelete(int $id)
    {
        $this->adminService->deleteBookById($id);
        return redirect()->route('admin.book.index');
    }

    /**
     * getCategoryByBookId
     *
     * @param  mixed $id
     * @return void
     */
    public function getCategoryByBookId(int $id)
    {
        echo Book::findOrFail($id)->category[0]->name;
    }

    /**
     * ebookIndex
     *
     * @param  mixed $r
     * @return void
     */
    public function ebookIndex(Request $r)
    {
        $ebooks = $this->adminService->getEbooks($r);
        return view('admin.ebook.index', compact('ebooks'));
    }

    /**
     * ebookCreate
     *
     * @param  mixed $r
     * @return void
     */
    public function ebookCreate(Request $r)
    {
        $categories = $this->adminService->getCategories($r);
        $authors = $this->adminService->getAuthors($r);
        return view('admin.ebook.create', compact(['categories', 'authors']));
    }

    /**
     * ebookStore
     *
     * @param  mixed $r
     * @return void
     */
    public function ebookStore(EbookRequest $r)
    {
        $this->adminService->createEbook($r);
        return redirect()->route('admin.ebook.index');
    }

    /**
     * ebookEdit
     *
     * @param  mixed $r
     * @param  mixed $id
     * @return void
     */
    public function ebookEdit(Request $r, int $id)
    {
        $ebook = $this->adminService->getEbookById($id);
        $categories = $this->adminService->getCategories($r);
        $authors = $this->adminService->getAuthors($r);
        return view('admin.ebook.edit', compact(['categories', 'authors', 'ebook']));
    }

    /**
     * ebookUpdate
     *
     * @param  mixed $r
     * @param  mixed $id
     * @return void
     */
    public function ebookUpdate(EbookRequest $r, int $id)
    {
        $this->adminService->updateEbook($r, $id);
        return redirect()->route('admin.ebook.index');
    }

    /**
     * ebookDelete
     *
     * @param  mixed $id
     * @return void
     */
    public function ebookDelete(int $id)
    {
        $this->adminService->deleteEbookById($id);
        return redirect()->route('admin.ebook.index');
    }

    /**
     * userIndex
     *
     * @param  mixed $r
     * @return void
     */
    public function userIndex(Request $r)
    {
        $users = $this->adminService->getUsers($r);
        return view('admin.user.index', compact('users'));
    }

    /**
     * userEdit
     *
     * @param  mixed $id
     * @return void
     */
    public function userEdit(int $id)
    {
        $user = $this->adminService->getUserById($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * userUpdate
     *
     * @param  mixed $r
     * @param  mixed $id
     * @return void
     */
    public function userUpdate(Request $r, int $id)
    {
        $this->adminService->updateUser($r->only([
            'role',
            'active',
        ]), $id);
        return redirect()->route('admin.user.index');
    }

    /**
     * userDelete
     *
     * @param  mixed $id
     * @return void
     */
    public function userDelete(int $id)
    {
        $this->adminService->deleteUser($id);
        return redirect()->route('admin.user.index');
    }

    /**
     * feedbackIndex
     *
     * @param  mixed $r
     * @return void
     */
    public function feedbackIndex(Request $r)
    {
        $feedbacks = $this->adminService->getFeedback($r);
        return view('admin.feedback.index', compact('feedbacks'));
    }

    /**
     * feedbackDetail
     *
     * @param  mixed $id
     * @return void
     */
    public function feedbackDetail(int $id)
    {
        return $this->adminService->getFeedbackById($id);
    }

    /**
     * feedbackDelete
     *
     * @param  mixed $id
     * @return void
     */
    public function feedbackDelete(int $id)
    {
        $this->adminService->deleteFeedback($id);
        return redirect()->route('admin.feedback.index');
    }
}
