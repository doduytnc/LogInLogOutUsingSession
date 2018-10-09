<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin(){
        return view('login');
    }

    public function login(Request $request){
        // Lấy thông tin đang nhập từ request được gửi lên từ trình duyệt
        $username = $request->inputUsername;
        $password = $request->inputPassword;

        // Kiểm tra thông tin đăng nhập
        if (($username == 'admin' && $password == '123456')||($username == 'doduy' && $password == '123456')) {

            //Nếu thông tin đăng nhập chính xác, Tạo một Session lưu trữ trạng thái đăng nhập (tạo ra một biến Session có key là login và giá trị bằng true, khi ta sử dụng push() biến Session này sẽ tồn tại liên tục cho đến người dùng logout (xóa Session) hoặc khi người dùng tắt trình duyệt thì session này sẽ bị xóa, đồng nghĩa với việc kết thúc phiên đăng nhập)
            $request->session()->push('login', true);
            $request->session()->flash('userLogin', $username);
            $userLog = $request->session()->get('userLogin');

            // Đi đến route show.blog, để chuyển hướng người dùng đến trang blog
            return view('blog', compact('userLog'));
        }

        // Nếu thông tin đăng nhập không chính xác, gán thông báo vào Session (Thì sẽ tạo ra 1 biến Session có key là login-fail và có giá trị là chuỗi thông báo, khi ta sử dụng flash() thì biến session này sẽ chỉ tồn tại duy nhất một lần trong lần truy xuất tiếp theo sau đó sẽ tự động xóa ngay. Có nghĩa là ta sẽ chỉ hiển thị thông báo trong biến session này 1 lần duy nhất ở ngoài view sau đó sẽ tự động xóa luôn)
        //Ko caàn dùng else vì nếu login thì đã return về show.blog rồi
        $message = 'Đăng nhập không thành công. Tên người dùng hoặc mật khẩu không đúng.';
        $request->session()->flash('login-fail', $message);

        //Quay trở lại trang đăng nhập
        return view('login');
    }
}
