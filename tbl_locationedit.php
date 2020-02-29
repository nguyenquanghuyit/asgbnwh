<?php
namespace PHPMaker2019\asgbn_wh;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tbl_location_edit = new tbl_location_edit();

// Run the page
$tbl_location_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_location_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftbl_locationedit = currentForm = new ew.Form("ftbl_locationedit", "edit");

// Validate form
ftbl_locationedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($tbl_location_edit->Location->Required) { ?>
			elm = this.getElements("x" + infix + "_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_location->Location->caption(), $tbl_location->Location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_location_edit->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_location->Description->caption(), $tbl_location->Description->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_locationedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_locationedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_location_edit->showPageHeader(); ?>
<?php
$tbl_location_edit->showMessage();
?>
<form name="ftbl_locationedit" id="ftbl_locationedit" class="<?php echo $tbl_location_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_location_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_location_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_location">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_location_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_location->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_tbl_location_Location" for="x_Location" class="<?php echo $tbl_location_edit->LeftColumnClass ?>"><?php echo $tbl_location->Location->caption() ?><?php echo ($tbl_location->Location->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_location_edit->RightColumnClass ?>"><div<?php echo $tbl_location->Location->cellAttributes() ?>>
<span id="el_tbl_location_Location">
<input type="text" data-table="tbl_location" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_location->Location->getPlaceHolder()) ?>" value="<?php echo $tbl_location->Location->EditValue ?>"<?php echo $tbl_location->Location->editAttributes() ?>>
</span>
<?php echo $tbl_location->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_location->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_tbl_location_Description" for="x_Description" class="<?php echo $tbl_location_edit->LeftColumnClass ?>"><?php echo $tbl_location->Description->caption() ?><?php echo ($tbl_location->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_location_edit->RightColumnClass ?>"><div<?php echo $tbl_location->Description->cellAttributes() ?>>
<span id="el_tbl_location_Description">
<input type="text" data-table="tbl_location" data-field="x_Description" name="x_Description" id="x_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_location->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_location->Description->EditValue ?>"<?php echo $tbl_location->Description->editAttributes() ?>>
</span>
<?php echo $tbl_location->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="tbl_location" data-field="x_ID_Location" name="x_ID_Location" id="x_ID_Location" value="<?php echo HtmlEncode($tbl_location->ID_Location->CurrentValue) ?>">
<?php if (!$tbl_location_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_location_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_location_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_location_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_location_edit->terminate();
?>