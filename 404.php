<?php
get_header();

?>

<h2>Oops! Page Not Found</h2>

<p class="lead">Sorry, your page you are looking for could not be found. It's possible it has been moved, or temporarily unavilable. Please use the search bar below to find the page you are looking for.</p>

<form class="form-inline" method="get" action="<?= home_url( '/' ) ?>">
	<input class="form-control mr-sm-2" name="s" type="search" placeholder="Search" aria-label="Search">
	<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
</form>


<?php
get_footer();
