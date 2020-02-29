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
$tbl_producttype_addopt = new tbl_producttype_addopt();

// Run the page
$tbl_producttype_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_producttype_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var ftbl_producttypeaddopt = currentForm = new ew.Form("ftbl_producttypeaddopt", "addopt");

// Validate form
ftbl_producttypeaddopt.validate = function() {
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
		<?php if ($tbl_producttype_addopt->IdType->Required) { ?>
			elm = this.getElements("x" + infix + "_IdType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_producttype->IdType->caption(), $tbl_producttype->IdType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_producttype_addopt->TypeName->Required) { ?>
			elm = this.getElements("x" + infix + "_TypeName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_producttype->TypeName->caption(), $tbl_producttype->TypeName->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_producttypeaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_producttypeaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_producttype_addopt->showPageHeader(); ?>
<?php
$tbl_producttype_addopt->showMessage();
?>
<form name="ftbl_producttypeaddopt" id="ftbl_producttypeaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($tbl_producttype_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_producttype_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $tbl_producttype_addopt->TableVar ?>">
<?php if ($tbl_producttype->IdType->Visible) { // IdType ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_IdType"><?php echo $tbl_producttype->IdType->caption() ?><?php echo ($tbl_producttype->IdType->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_producttype" data-field="x_IdType" name="x_IdType" id="x_IdType" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($tbl_producttype->IdType->getPlaceHolder()) ?>" value="<?php echo $tbl_producttype->IdType->EditValue ?>"<?php echo $tbl_producttype->IdType->editAttributes() ?>>
<?php echo $tbl_producttype->IdType->CustomMsg ?></div>
	</div>
<?php } ?>
<?php if ($tbl_producttype->TypeName->Visible) { // TypeName ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_TypeName"><?php echo $tbl_producttype->TypeName->caption() ?><?php echo ($tbl_producttype->TypeName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="tbl_producttype" data-field="x_TypeName" name="x_TypeName" id="x_TypeName" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($tbl_producttype->TypeName->getPlaceHolder()) ?>" value="<?php echo $tbl_producttype->TypeName->EditValue ?>"<?php echo $tbl_producttype->TypeName->editAttributes() ?>>
<?php echo $tbl_producttype->TypeName->CustomMsg ?></div>
	</div>
<?php } ?>
</form>
<?php
$tbl_producttype_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$tbl_producttype_addopt->terminate();
?>