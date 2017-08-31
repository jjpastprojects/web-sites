$(function() {
	var close_btn	 				= $('.panel .panel-heading .close-product-panel');
	
	var panel_active_class 			= 'active';


	close_btn.on('click', function() {
		w.close_panel(
			$(this).parents().closest('.left-sliding-panel').data('panel')
		);
	});
	
	$('[data-open-panel]').each(function(i, v) {
		$(v).on('click', function(e) {
			e.preventDefault();

			w.toggle_panel($(this).data('open-panel'));
		});
	});

	//app panel
	var appPanel = function(name, w) {
		this.name 		= name;

		this.panel 		= $('.left-sliding-panel.' + name);

		this.active 	= false;

		this.w 			= w;
	}

	appPanel.prototype.open = function() {		
		this.active = true;

		this.panel.addClass(panel_active_class);

		this.w.active_panel = this;
	}

	appPanel.prototype.close = function() {
		this.active = false;

		this.panel.removeClass(panel_active_class);

		this.w.active_panel = false;
	}
	// end app panel


	//app window
	var appWindow = function() {

		this.panels 			= [];
		this.available_panels 	= ['cart', 'share', 'change-product'];
		
		this.active_panel 		= false;

		for(var i = 0; i < this.available_panels.length; i++)
		{
			this.panels.push(
				new appPanel(this.available_panels[i], this)
			);
		}
	}
	
	appWindow.prototype.get_active_panel = function() {
		return this.active_panel;
	}

	appWindow.prototype.panel = function(panel) {

		for(var i = 0; i < this.panels.length; i++)
		{
			if(this.panels[i].name == panel)
				return this.panels[i];
		}

		return false;
	}

	appWindow.prototype.open_panel = function(panel) {
		this.panel(panel).open();
	}

	appWindow.prototype.close_panel = function(panel) {
		this.panel(panel).close();
	}

	appWindow.prototype.toggle_panel = function(panel) {
		if(this.get_active_panel())
			this.get_active_panel().close();
		
		var panel = this.panel(panel);
		
		panel.active ? panel.close() : panel.open();
	}
	// end app window


	var w = new appWindow();
});

function open_customizer_panel(panel)
{
	panel.addClass('active');
}

function close_customizer_panel(panel)
{
	panel.removeClass('active');
}
