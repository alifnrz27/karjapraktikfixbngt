<div class="rounded-lg bg-primary dark:bg-slate-700 h-full lg:w-[70px] right-0 fixed my-auto">                
    <div id="nav-menu-aside" class="w-full mb-12 pt-10 my-auto justify-center items-center">
        <a href="/dashboard" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/dashboard.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        <a href="/project/create" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/project.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        <a href="/blog/create" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/blog.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        <a href="/experience/create" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/experience.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        <a href="/category/create" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/subfolder.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        <a href="/user/profile" class="">
            <div class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/user.png" width="40px" class="mx-auto" alt="">
            </div>
        </a>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="container flex mb-4 py-2 hover:bg-white hover:rounded-lg transition duration-300">
                <img src="/assets/images/icons/logout.png" width="40px" class="mx-auto" alt="">
            </button>
        </form>
    </div>
</div>