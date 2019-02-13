jQuery(document).ready( function() {
	
});

function hero_add_button () {
	jQuery("#hero-buttons-preview-meta").append('<span class="hero-button-wrapper-meta" id="hero-button-new-meta"><button type="button" class="hero-button-meta">New Button</button><div class="hero-button-edit-meta" style="left: -9999px;"><span class="hero-button-close-meta">&times;</span><label>URL:</label><br><input type="url" name="hero-button-url[]" value="https://camptrillium.com/"><br><label>Text:</label><br><input type="text" name="hero-button-text[]" value="New Button"><br><a href="#" class="hero-button-delete-meta" data-confirm="yes">Delete</a></div></span>');
	
	jQuery("#hero-button-new-meta .hero-button-meta").click(function(e) { this.nextElementSibling.style.left = '12px'; });
	jQuery("#hero-button-new-meta .hero-button-close-meta").click(function(e) { this.parentElement.style.left = '-9999px'; });
	jQuery("#hero-button-new-meta [name='hero-button-text[]']").keyup(function(e) { this.parentElement.previousElementSibling.innerHTML = this.value; });
	jQuery("#hero-button-new-meta .hero-button-delete-meta").click(function(e) {
		if (this.dataset.confirm == 'yes') {
			this.dataset.confirm = '';
			this.innerHTML = 'Click to confirm delete';
		} else {
			this.parentElement.parentElement.remove();
		}
		return false;
	});
	
	jQuery("#hero-button-new-meta").removeAttr("id");
	
}
