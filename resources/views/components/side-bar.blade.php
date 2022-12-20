<div class="rounded-lg bg-primary dark:bg-slate-700 h-full lg:w-[70px] right-0 fixed my-auto">                
    <div id="nav-menu-aside" class="w-full mb-12 pt-10 my-auto justify-center items-center">
        <div title="mode" class="flex items-center mt-3 lg:mt-0 mb-4 mx-auto">
            <div class="flex mx-auto">
                <input type="checkbox" class="hidden" id="dark-toggle">
                <label for="dark-toggle">
                    <div class="flex h-5 w-9 cursor-pointer items-center rounded-full bg-white p-1">
                        <div class="toggle-circle h-4 w-4 rounded-full bg-primary transition duration-300 "></div>
                    </div>
                </label>
            </div>
        </div>
        <a title="dashboard" href="/dashboard" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/dashboard.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        @if(auth()->user()->role_id == 3)
        <a title="register" href="/student-register" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/register.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        @endif
        @if(auth()->user()->role_id == 1)
        <a title="calender" href="/calender" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/calendar.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        <a title="users" href="/users" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/man.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        @endif
        <a title="profile"  href="/user/profile" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/user.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        <form title="logout" action="/logout" method="POST">
            @csrf
            <button type="submit" class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/logout.png" width="40px" class="mx-auto" alt="">
            </button>
        </form>
    </div>
</div>