<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AdminServiceInterface;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\BookRequest;
use App\Http\Requests\EbookRequest;
use Illuminate\Support\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

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
    public function changePassword(PasswordRequest $r)
    {
        $this->adminService->password($r->only([
            'oldPassword',
            'newPassword',
            'confirmPassword',
        ]));
         return redirect()->route('auth.loginPage')->with(['successPwChange'=>'Successfully Change Password...']);
    }
    public function updateAdmin(ProfileRequest $request,int $id){
        $this->adminService->adminProfile($request,$id);
        return redirect()->route('admin.details');
    }

    public function categoryIndex()
    {
        $categories = $this->adminService->getCategories();
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

    public function authorIndex()
    {
        $authors = $this->adminService->getAuthors();
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

    public function bookCreate()
    {
        $categories = $this->adminService->getCategories();
        $authors = $this->adminService->getAuthors();
        return view('admin.book.create', compact(['categories', 'authors']));
    }

    public function bookStore(BookRequest $r)
    {
        $this->adminService->createBook($r);
        return redirect()->route('admin.book.index');
    }

    public function bookEdit(int $id)
    {
        $book = $this->adminService->getBookById($id);
        $categories = $this->adminService->getCategories();
        $authors = $this->adminService->getAuthors();
        return view('admin.book.edit', compact(['categories', 'authors', 'book']));
    }

    public function bookUpdate(BookRequest $r, int $id)
    {
        $this->adminService->updateBook($r->only([
            'title',
            'description',
            'pagecount',
            'price',
        ]), $id);
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

    public function ebookCreate()
    {
        $categories = $this->adminService->getCategories();
        $authors = $this->adminService->getAuthors();
        return view('admin.ebook.create', compact(['categories', 'authors']));
    }

    public function ebookStore(EbookRequest $r)
    {
        $this->adminService->createEbook($r);
        return redirect()->route('admin.ebook.index');
    }

    public function ebookEdit(int $id)
    {
        $ebook = $this->adminService->getEbookById($id);
        $categories = $this->adminService->getCategories();
        $authors = $this->adminService->getAuthors();
        return view('admin.ebook.edit', compact(['categories', 'authors', 'ebook']));
    }

    public function ebookUpdate(EbookRequest $r, int $id)
    {
        $this->adminService->updateEbook($r->only([
            'title',
            'description',
            'pagecount',
            'price',
            'link',
        ]), $id);
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
        $feedback = $this->adminService->getFeedback($r);
        return view('admin.feedback.index', compact('feedback'));
    }

    public function feedbackDetail(int $id)
    {
        $feedback = $this->adminService->getFeedbackById($id);
        return view('admin.feedback.detail', compact('feedback'));
    }

    public function feedbackDelete(int $id)
    {
        $this->adminService->deleteFeedback($id);
        return redirect()->route('admin.feedback.index');
    }
}
