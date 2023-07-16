<div class="container-lg" id="top-menu">
    <div class="container-fluiddd">
        <div class="d-flex justify-content-between align-items-center pe-5 ps-5" id="top-menu-items">
            <div class="menu">
                <button class="btn menu-btn nav-link p-2" style="font-size: 20px" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                    <i class="bi bi-list"></i>
                </button>
                <ul class="nav" id="left-nav">
                    <!--Menu Here from script.blade.php-->
                </ul>
            </div>
            <div class="logo">
                <a href="{{route('user.home')}}" class=" text-decoration-none text-uppercase">
                    <h3 class="m-0"><span class="text-dark">Bong</span><span style="color: var(--font-highlight)">TV</span></h3>
                </a>
            </div>
            <div class="icons">
                <ul class="nav d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link fw-400" data-bs-toggle="modal" data-bs-target="#search-modal" href="#">
                            <i class="bi bi-search"></i>
                        </a>
                    </li>
                    <li class="nav-item d-md-block d-none" id="subscription_menu_item">
                        <a class="nav-link fw-400" href="{{route('user.subscription')}}">
                            <i class="bi bi-percent"></i>
                        </a>
                    </li>
                    <li class="nav-item d-md-block d-none">
                        <a class="nav-link fw-400" href="{{route('user.favourite')}}">
                            <i class="bi bi-suit-heart"></i>
                        </a>
                    </li>
                    <li class="nav-item d-md-block d-none">
                        <a class="nav-link fw-400" href="#">
                            <i class="bi bi-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item d-md-block d-none" id="auth_menu">

                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script>
    client.get('/menu')
        .then(function(response) {
            if (response.status === 200) {
                let data = response.data;
                let menu = data.menu;
                let subscription_visibility = data.subscription_visibility;
                let user = data.user;

                if (subscription_visibility == false) {
                    $('#subscription_menu_item').remove();
                }

                if (user == "" || user == null) {
                    loginView();
                } else {
                    profileView(user);
                }

                //Menu
                let left_nav_el = $('#left-nav');
                let sidebar_nav = $('#sidebar-nav');
                left_nav_el.empty();
                sidebar_nav.empty();
                menu.forEach(function(item) {
                    if (item.sub_category.length > 0) {
                        let sidebar_drop = `<li class="nav-item">
                                        <a class="nav-link dropdown-nav-btn" data-bs-toggle="collapse" href="/${item.name}">${item.display_name} &nbsp;&nbsp;<i class="bi bi-chevron-down"></i></a>
                                        <ul  id="${item.name}" class="collapse nav dropdown-nav flex-column">
                                        `;
                        let dropdown = `<li class="nav-item">
                                    <div class="dropdown">
                                    <a class="nav-link dropdown-toggle fw-400" href="/" data-bs-toggle="dropdown">${item.display_name}</a>
                                    <ul class="dropdown-menu">`
                        item.sub_category.forEach(function(sub_item) {
                            dropdown += `<li><a class="dropdown-item" href="/genre/${sub_item.name}">${sub_item.display_name}</a></li>`
                            sidebar_drop += `<li class="nav-item">
                                            <a class="nav-link" href="/genre/${sub_item.name}">${sub_item.display_name}</a>
                                            </li>`
                        })
                        dropdown += `</ul>
                                     </div>
                                     </li>`;
                        sidebar_drop += `
                                        </ul>
                                        </li>
                                        `
                        left_nav_el.append(dropdown)
                        sidebar_nav.append(sidebar_drop)
                    } else {
                        left_nav_el.append(`
                        <li class="nav-item">
                            <a class="nav-link fw-400" href="/${item.name}">${item.display_name}</a>
                        </li>
                    `);
                        sidebar_nav.append(`
                        <li class="nav-item">
                            <a class="nav-link" href="/${item.name}">${item.display_name}</a>
                        </li>
                    `)
                    }
                });
                //End Menu
            }
        })
        .catch(function(error) {

        })




    function loginView() {
        let page_link = "{{route('account')}}";
        $('#auth_menu').append(`
                <a class="nav-link fw-400" href="${page_link}">
                   Login
                </a>
            `)
    }

    function profileView(user) {
        $('#auth_menu').append(`
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle fw-400" href="#" data-bs-toggle="dropdown">${(user.first_name == "" || user.first_name == null) ? 'user' : user.first_name}</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="nav-link fw-400 d-flex  align-items-center" href="#">
                                <img
                                        src="https://pbs.twimg.com/profile_images/1485050791488483328/UNJ05AV8_400x400.jpg"
                                        style="border-radius: 50%"
                                        height="45px" width="45px"
                                        class="me-2"
                                >
                                <div style="font-size: 14px">
                                    <span>hi!</span><br>
                                    <p class="m-0">${(user.first_name == "" || user.first_name == null) ? 'user' : user.first_name }</p>
                                </div>
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="#">Watch History</a></li>
                        <li><a class="dropdown-item" id="logout-btn" href="#">Logout</a></li>
                    </ul>
                </div>
            `);
    }

    $('#auth_menu').on('click', '#logout-btn', function(e) {

        e.preventDefault();
        logout();
    })
</script>
