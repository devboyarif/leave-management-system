<script src="{{ asset('website') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('website') }}/js/wow.min.js"></script>
<script src="{{ asset('admin') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="{{ asset('admin') }}/plugins/jquery/jquery-3.6.0.min.js"></script>
<script src="{{ asset('website') }}/js/main.js"></script>
<script>
    // ==== for menu scroll
    const pageLink = document.querySelectorAll(".ud-menu-scroll");

    // section menu active
    function onScroll(event) {
        const sections = document.querySelectorAll(".ud-menu-scroll");
        const scrollPos =
            window.pageYOffset ||
            document.documentElement.scrollTop ||
            document.body.scrollTop;

        for (let i = 0; i < sections.length; i++) {
            const currLink = sections[i];
            const val = currLink.getAttribute("href");
            const refElement = document.querySelector(val);
            const scrollTopMinus = scrollPos + 73;
            if (
                refElement.offsetTop <= scrollTopMinus &&
                refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
            ) {
                document
                    .querySelector(".ud-menu-scroll")
                    .classList.remove("active");
                currLink.classList.add("active");
            } else {
                currLink.classList.remove("active");
            }
        }
    }

    window.document.addEventListener("scroll", onScroll);

    $('.login_required').on('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: "Login Required",
            text: "Please login your account first. ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Login now!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.value) {
                window.location.href = route('login');
            }
        })
    });

    $('.not_acceptable').on('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: "Not Acceptable",
            text: "Sorry, admins are not allowed to perform this action. ",
            icon: "warning",
            dangerMode: true,
        })
    });
</script>

@yield('custom-scripts')
