<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AdminServiceInterface;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminDash()
    {
        return view('admin.dashboard');
    }
    private $adminService;

    public function __construct(AdminServiceInterface $adminServiceInterface)
    {
        $this->adminService = $adminServiceInterface;
    }
    public function changePasswordPage(){
        return view('admin.profile.change');
    }
    public function changePassword(PasswordRequest $request){
        $this->adminService->password($request->only([
            'oldPassword',
            'newPassword',
            'confirmPassword',
        ]));
         return redirect()->route('auth.loginPage')->with(['successPwChange'=>'Successfully Change Password...']);
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

    public function categoryStore(CategoryRequest $request)
    {
        $this->adminService->createCategory($request->only([
            'name',
        ]));
        return redirect()->route('admin.category.index');
    }

    public function categoryEdit(int $id)
    {
        $category = $this->adminService->getCategoryById($id);
        return view('admin.category.edit', compact('category'));
    }

    public function categoryUpdate(CategoryRequest $request, int $id)
    {
        $this->adminService->updateCategory($request->only([
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

    public function authorStore(AuthorRequest $request)
    {
        $this->adminService->createAuthor($request->only([
            'name',
        ]));
        return redirect()->route('admin.author.index');
    }

    public function authorEdit(int $id)
    {
        $author = $this->adminService->getAuthorById($id);
        return view('admin.author.edit', compact('author'));
    }

    public function authorUpdate(AuthorRequest $request, int $id)
    {
        $this->adminService->updateAuthor($request->only([
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

    public function orderAccept(int $id)
    {
        $this->adminService->acceptOrderById($id);
        return redirect()->route('admin.order.index');
    }

    public function orderDecline(int $id)
    {
        $this->adminService->declineOrderById($id);
        return redirect()->route('admin.order.index');
    }
}
