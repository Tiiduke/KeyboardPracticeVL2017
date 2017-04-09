<!--
To whom it may concern:
currently, this screen does not have any kind of error throws, when, for example,
a text box is left unfilled. However, it most certainly would benefit from such
a thing, therefore, this needs to eventually be implemented, using either
JavaScript, or PHP, whichever strikes your fancy more.
-->

<form action= "/action_page.php"> <!--Needs an actual separate webpage for this-->
<fieldset>
<legend><?php echo lang("SearchT"); ?></legend>
	<div id="nameEntry">
		<label for="keyword"><?php echo lang("SearchKey"); ?></label>
		<input type="text" id="keyword" name="keyword" value=""><br>
		<label for="author"><?php echo lang("SearchAuth"); ?></label>
		<input type="text" id="author" name="author" value=""><br><br>
	</div>
	
	
	<div id="catType">
		<label for="category"><?php echo lang("SearchCate"); ?></label> 
		<select id="category">
		<option value="cat1"><?php echo lang("Category1"); ?></option>
		<option value="cat2"><?php echo lang("Category2"); ?></option>
		</select>
	</div>
	
	<div id="ageFilter">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" />
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript" src="../../js/datepick.js">
		</script>
		<?php echo lang("SearchFilAge"); ?> <label for="from"><?php echo lang("SearchAgeFr"); ?> </label>
		<input type="text" id="from" name="from">
		<label for="to"><?php echo lang("SearchAgeTo"); ?></label>
		<input type="text" id="to" name="to">
		 
	</div>
	
	<div id="newOrOld">
		<?php echo lang("SearchFilTim"); ?> <input type="radio" name="pollAge" id="newer" value="1" checked="checked">
		<label for="newer"><?php echo lang("SearchTimNew"); ?></label>
		<input type="radio" name="pollAge" id="older" value="2">
		<label for="older"><?php echo lang("SearchTimOld"); ?></label>
	</div>
	
	<div id="popularityFilter">
		<?php echo lang("SearchFilPop"); ?> <input type="radio" name="pollPopularity" id="more" value="1" checked="checked">
		<label for="more"><?php echo lang("SearchPopMor"); ?></label>
		<input type="radio" name="pollPopularity" id="less" value="2">
		<label for="less"><?php echo lang("SearchPopLes"); ?></label>
	</div>
	
	<div id="pollActivity">
		<?php echo lang("SearchFilAct"); ?> <input type="radio" name="pollActivity" id="active" value="1">
		<label for="active"><?php echo lang("SearchPolAc"); ?></label>
		<input type="radio" name="pollActivity" id="closed" value="2">
		<label for="closed"><?php echo lang("SearchPolCl"); ?></label>
		<input type="radio" name="pollActivity" id="all" value="3" checked="checked">
		<label for="all"><?php echo lang("SearchPolAl"); ?></label>
	</div>
	
	</fieldset>
	
	<input type="submit" value=<?php echo lang("SearchSearch"); ?>>
</form>
