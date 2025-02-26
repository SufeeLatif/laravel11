		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fe fe-chevrons-up"></i></a>

		<!-- Jquery js-->
		<script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script>

		<!-- Bootstrap4 js-->
		<script src="{{ asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

		<!--Othercharts js-->
		<script src="{{ asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>

		<!-- Circle-progress js-->
		<script src="{{ asset('assets/js/circle-progress.min.js')}}"></script>

		<!-- Jquery-rating js-->
		<script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

		<!--Sidemenu js-->
		<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>
		
		<!-- P-scroll js-->
		<script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
		<script src="{{ asset('assets/plugins/p-scrollbar/p-scroll1.js')}}"></script>
		<script src="{{ asset('assets/plugins/p-scrollbar/p-scroll.js')}}"></script>

		@yield('js')
		<!-- Simplebar JS -->
		<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
		<!-- Custom js-->
		<script src="{{ asset('assets/js/custom.js')}}"></script>		

		<script>
			$(document).on("click", ".themeclick", function () {
				let newTheme = $(this).attr("data-theme"); // Get the new theme value (1 or 0)
		
				$.ajax({
					url: "{{ route('toggleTheme') }}",
					type: "POST",
					data: {
						theme: newTheme,
						_token: "{{ csrf_token() }}" // CSRF protection
					},
					success: function (response) {
						if (response.status === "success") {
							location.reload(); // Refresh page to apply changes
						}
					},
					error: function () {
						alert("Something went wrong. Please try again.");
					}
				});
			});
		</script>