<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('verbiage_top_line',trans('messages.Top Line'),[])!!}
		{!! Form::select('verbiage_top_line', [
					''=>'',
					'Store Closing' => 'Store Closing',
					'Grand Opening' => 'Grand Opening',
					'$1,000,000 Store Closing Sale' => '$1,000,000 Store Closing Sale',
					'$1,000,000 Quitting Business Sale' => '$1,000,000 Quitting Business Sale',
					'$1,000,000 Retirement Sell-Off!!!' => '$1,000,000 Retirement Sell-Off!!!',
					'Grand Opening Sale' => 'Grand Opening Sale',
					'Store Closing for Remodeling' => 'Store Closing for Remodeling',
					'$2,000,000 Remodeling Furniture Sell-Off' => '$2,000,000 Remodeling Furniture Sell-Off',
					'$5,000,000 Immediate Warehouse Furniture Sell-Off' => '$5,000,000 Immediate Warehouse Furniture Sell-Off',
					'Immediate $15,000,000 Warehouse Furniture Sell-Off' => 'Immediate $15,000,000 Warehouse Furniture Sell-Off',
					'Renovation Sale' => 'Renovation Sale',
					'Save Up to 25%' => 'Save Up to 25%',
					'Remodeling Sale' => 'Remodeling Sale',
					'Storewide Liquidation' => 'Storewide Liquidation',
					'Remerchandising Liquidation' => 'Remerchandising Liquidation',
					'Storewide Inventory Sale' => 'Storewide Inventory Sale',
					'$25,000,000 Inventory Liquidation' => '$25,000,000 Inventory Liquidation',
					'N/A' => 'N/A',
				],isset($location->verbiage_top_line) ? $location->verbiage_top_line : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Sign Type'])!!}
	</div>
</div>
<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('verbiage_star_burst',trans('messages.Star Burst / Discounts'),[])!!}
		{!! Form::select('verbiage_star_burst', [
					''=>'',
					'Ground' => 'Ground',
					'Auction Tomorrow 1:30PM' => 'Auction Tomorrow 1:30PM',
					'Up to 60% Off' => 'Up to 60% Off',
					'Decal' => 'Decal',
					'Don&#039;t Miss It!!!' => 'Don&#039;t Miss It!!!',
					'Huge Discounts' => 'Huge Discounts',
					'Save Up to 70% Off' => 'Save Up to 70% Off',
					'UP to 70% Off' => 'UP to 70% Off',
					'Lowest Prices' => 'Lowest Prices',
					'Save UP to 50% Off' => 'Save UP to 50% Off',
					'All Furniture Must Go!' => 'All Furniture Must Go!',
					'Up to 30% Off' => 'Up to 30% Off',
					'Lowest Ticketed Price' => 'Lowest Ticketed Price',
					'10 - 30% Off' => '10 - 30% Off',
					'20 - 50% Off' => '20 - 50% Off',
					'20 - 40% Off' => '20 - 40% Off',
				],isset($location->verbiage_star_burst) ? $location->verbiage_star_burst : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Sign Type'])!!}
	</div>
</div>
<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('verbiage_store_name',trans('messages.Store Name').' *',[])!!}
		{!! Form::select('verbiage_store_name', [
					''=>'',
					'Furniture King' => 'Furniture King',
					'Scott`s Fine Furniture' => 'Scott`s Fine Furniture',
					'Beds Direct' => 'Beds Direct',
					'Slumberland Furniture' => 'Slumberland Furniture',
					'Connolloy`s Furnitur' => 'Connolloy`s Furnitur',
					'Chapin Furniture.Com' => 'Chapin Furniture.Com',
					'Hudson`s Furniture' => 'Hudson`s Furniture',
					'Ashely Homestore' => 'Ashely Homestore',
					'Ashley Furniture' => 'Ashley Furniture',
					'Save UP to 50% Off' => 'Save UP to 50% Off',
					'Furniture Fair' => 'Furniture Fair',
					'Midtown Furniture Superstore' => 'Midtown Furniture Superstore',
					'Lowest Ticketed Price' => 'Lowest Ticketed Price',
					'Regency Furniture Outlet' => 'Regency Furniture Outlet',
					'Gander Mountain' => 'Gander Mountain',
					'Bob`s Stores' => 'Bob`s Stores',
					'Eastern Mountain Sports' => 'Eastern Mountain Sports',
					'Sport Chalet' => 'Sport Chalet',
					'Joann`s Fabrics And Crafts' => 'Joann`s Fabrics And Crafts',
					'Scoop NYC' => 'Scoop NYC',
					'Test' => 'Test',
				],isset($location->verbiage_store_name) ? $location->verbiage_store_name : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Sign Type'])!!}
	</div>
</div>
<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('verbiage_bottom_line',trans('messages.Bottom Line').' *',[])!!}
		{!! Form::select('verbiage_bottom_line', [
					''=>'',
					'Everything Must Go!' => 'Everything Must Go!',
					'Bad Credit No Credit You Are Approved' => 'Bad Credit No Credit You Are Approved',
					'Furniture & Bedding' => 'Furniture & Bedding',
					'Huge Savings!!!' => 'Huge Savings!!!',
					'Going On Now' => 'Going On Now',
					'Immediate' => 'Immediate',
					'Blowout Pricing!' => 'Blowout Pricing!',
					'All Furniture Groups reduced' => 'All Furniture Groups reduced',
					'Entire Store On Sale!' => 'Entire Store On Sale!',
				],isset($location->verbiage_bottom_line) ? $location->verbiage_bottom_line : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Sign Type'])!!}
	</div>
</div>
<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('verbiage_additional_lines',trans('messages.Additional Lines'),[])!!}
		{!! Form::select('verbiage_additional_lines', [
					''=>'',
					'Huge Savings!!!' => 'Huge Savings!!!',
					'This Location Only' => 'This Location Only',
					'Don`t Miss It!!!' => 'Don`t Miss It!!!',
					'6 Years No Interest' => '6 Years No Interest',
					'Everythiing Must Go!' => 'Everythiing Must Go!',
				],isset($location->verbiage_additional_lines) ? $location->verbiage_additional_lines : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Sign Type'])!!}
	</div>
</div>
<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('verbiage_address',trans('messages.Address'),[])!!}
		{!! Form::select('verbiage_address', [
					''=>'',
					'Pull from Contact Fields' => 'Pull from Contact Fields',
				],isset($location->verbiage_address) ? $location->verbiage_address : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Sign Type'])!!}
	</div>
</div>