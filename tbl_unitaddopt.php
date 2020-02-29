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
$tbl_unit_addopt = new tbl_unit_addopt();

// Run the page
$tbl_unit_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unit_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var ftbl_unitaddopt = currentForm = new ew.Form("ftbl_unitaddopt", "addopt");

// Validate form
ftbl_unitaddopt.validate = function() {
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
		<?php if ($tbl_unit_addopt->UnitName->Required) { ?>
			elm = this.getElements("x" + infix + "_UnitName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unit->UnitName->caption(), $tbl_unit->UnitName->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_unitaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_unitaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_unit_addopt->showPageHeader(); ?>
<?php
$tbl_unit_addopt->showMessage();
?>
<form name="ftbl_unitaddopt" id="ftbl_unitaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($tbl_unit_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_unit_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $tbl_unit_addopt->TableVar ?>">
<?php if ($tbl_unit->UnitName->Visible) { // UnitName ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_UnitName"><?php echo $tbl_unit->UnitName->caption() ?><?php echo ($tbl_unit->UnitName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_unit" data-field="x_UnitName" name="x_UnitName" id="x_UnitName" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($tbl_unit->UnitName->getPlaceHolder()) ?>" value="<?php echo $tbl_unit->UnitName->EditValue ?>"<?php echo $tbl_unit->UnitName->editAttributes() ?>>
<?php echo $tbl_unit->UnitName->CustomMsg ?></div>
	</div>
<?php } ?>
</form>
<?php
$tbl_unit_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$tbl_unit_addopt->terminate();
?>