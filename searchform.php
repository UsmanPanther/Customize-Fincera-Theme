<div class="sidebar-search">
	<form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="search-form">
		<div class="form-group">
			<input type="search" id="<?php echo esc_attr(uniqid('search-form-')); ?>" name="s" placeholder="<?php esc_attr_e('Search', 'fionca'); ?>" value="<?php echo get_search_query(); ?>" required="required">
			<button type="submit"><i class="fas fa-search"></i></button>
		</div>
	</form>
</div>