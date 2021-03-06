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
$tbl_unit_edit = new tbl_unit_edit();

// Run the page
$tbl_unit_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unit_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftbl_unitedit = currentForm = new ew.Form("ftbl_unitedit", "edit");

// Validate form
ftbl_unitedit.validate = function() {
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
		<?php if ($tbl_unit_edit->idUnit->Required) { ?>
			elm = this.getElements("x" + infix + "_idUnit");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unit->idUnit->caption(), $tbl_unit->idUnit->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unit_edit->UnitName->Required) { ?>
			elm = this.getElements("x" + infix + "_UnitName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unit->UnitName->caption(), $tbl_unit->UnitName->RequiredErrorMessage)) ?>");
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
ftbl_unitedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_unitedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_unit_edit->showPageHeader(); ?>
<?php
$tbl_unit_edit->showMessage();
?>
<form name="ftbl_unitedit" id="ftbl_unitedit" class="<?php echo $tbl_unit_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_unit_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_unit_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_unit">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_unit_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_unit->idUnit->Visible) { // idUnit ?>
	<div id="r_idUnit" class="form-group row">
		<label id="elh_tbl_unit_idUnit" class="<?php echo $tbl_unit_edit->LeftColumnClass ?>"><?php echo $tbl_unit->idUnit->caption() ?><?php echo ($tbl_unit->idUnit->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_unit_edit->RightColumnClass ?>"><div<?php echo $tbl_unit->idUnit->cellAttributes() ?>>
<span id="el_tbl_unit_idUnit">
<span<?php echo $tbl_unit->idUnit->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unit->idUnit->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unit" data-field="x_idUnit" name="x_idUnit" id="x_idUnit" value="<?php echo HtmlEncode($tbl_unit->idUnit->CurrentValue) ?>">
<?php echo $tbl_unit->idUnit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_unit->UnitName->Visible) { // UnitName ?>
	<div id="r_UnitName" class="form-group row">
		<label id="elh_tbl_unit_UnitName" for="x_UnitName" class="<?php echo $tbl_unit_edit->LeftColumnClass ?>"><?php echo $tbl_unit->UnitName->caption() ?><?php echo ($tbl_unit->UnitName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_unit_edit->RightColumnClass ?>"><div<?php echo $tbl_unit->UnitName->cellAttributes() ?>>
<span id="el_tbl_unit_UnitName">
<input type="text" data-table="tbl_unit" data-field="x_UnitName" name="x_UnitName" id="x_UnitName" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($tbl_unit->UnitName->getPlaceHolder()) ?>" value="<?php echo $tbl_unit->UnitName->EditValue ?>"<?php echo $tbl_unit->UnitName->editAttributes() ?>>
</span>
<?php echo $tbl_unit->UnitName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_unit_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_unit_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_unit_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_unit_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_unit_edit->terminate();
?>