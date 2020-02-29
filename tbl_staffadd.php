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
$tbl_staff_add = new tbl_staff_add();

// Run the page
$tbl_staff_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_staff_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_staffadd = currentForm = new ew.Form("ftbl_staffadd", "add");

// Validate form
ftbl_staffadd.validate = function() {
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
		<?php if ($tbl_staff_add->Ma_NV->Required) { ?>
			elm = this.getElements("x" + infix + "_Ma_NV");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_staff->Ma_NV->caption(), $tbl_staff->Ma_NV->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_staff_add->hoVaTen->Required) { ?>
			elm = this.getElements("x" + infix + "_hoVaTen");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_staff->hoVaTen->caption(), $tbl_staff->hoVaTen->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_staff_add->gioiTinh->Required) { ?>
			elm = this.getElements("x" + infix + "_gioiTinh");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_staff->gioiTinh->caption(), $tbl_staff->gioiTinh->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_staff_add->ngaySinh->Required) { ?>
			elm = this.getElements("x" + infix + "_ngaySinh");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_staff->ngaySinh->caption(), $tbl_staff->ngaySinh->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ngaySinh");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_staff->ngaySinh->errorMessage()) ?>");
		<?php if ($tbl_staff_add->emailCaNhan->Required) { ?>
			elm = this.getElements("x" + infix + "_emailCaNhan");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_staff->emailCaNhan->caption(), $tbl_staff->emailCaNhan->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_staff_add->CD_ID->Required) { ?>
			elm = this.getElements("x" + infix + "_CD_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_staff->CD_ID->caption(), $tbl_staff->CD_ID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CD_ID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_staff->CD_ID->errorMessage()) ?>");
		<?php if ($tbl_staff_add->TD_ID->Required) { ?>
			elm = this.getElements("x" + infix + "_TD_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_staff->TD_ID->caption(), $tbl_staff->TD_ID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_TD_ID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_staff->TD_ID->errorMessage()) ?>");
		<?php if ($tbl_staff_add->PB_ID->Required) { ?>
			elm = this.getElements("x" + infix + "_PB_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_staff->PB_ID->caption(), $tbl_staff->PB_ID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PB_ID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_staff->PB_ID->errorMessage()) ?>");

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
ftbl_staffadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_staffadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_staff_add->showPageHeader(); ?>
<?php
$tbl_staff_add->showMessage();
?>
<form name="ftbl_staffadd" id="ftbl_staffadd" class="<?php echo $tbl_staff_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_staff_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_staff_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_staff">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_staff_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_staff->Ma_NV->Visible) { // Ma_NV ?>
	<div id="r_Ma_NV" class="form-group row">
		<label id="elh_tbl_staff_Ma_NV" for="x_Ma_NV" class="<?php echo $tbl_staff_add->LeftColumnClass ?>"><?php echo $tbl_staff->Ma_NV->caption() ?><?php echo ($tbl_staff->Ma_NV->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_staff_add->RightColumnClass ?>"><div<?php echo $tbl_staff->Ma_NV->cellAttributes() ?>>
<span id="el_tbl_staff_Ma_NV">
<input type="text" data-table="tbl_staff" data-field="x_Ma_NV" name="x_Ma_NV" id="x_Ma_NV" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_staff->Ma_NV->getPlaceHolder()) ?>" value="<?php echo $tbl_staff->Ma_NV->EditValue ?>"<?php echo $tbl_staff->Ma_NV->editAttributes() ?>>
</span>
<?php echo $tbl_staff->Ma_NV->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_staff->hoVaTen->Visible) { // hoVaTen ?>
	<div id="r_hoVaTen" class="form-group row">
		<label id="elh_tbl_staff_hoVaTen" for="x_hoVaTen" class="<?php echo $tbl_staff_add->LeftColumnClass ?>"><?php echo $tbl_staff->hoVaTen->caption() ?><?php echo ($tbl_staff->hoVaTen->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_staff_add->RightColumnClass ?>"><div<?php echo $tbl_staff->hoVaTen->cellAttributes() ?>>
<span id="el_tbl_staff_hoVaTen">
<input type="text" data-table="tbl_staff" data-field="x_hoVaTen" name="x_hoVaTen" id="x_hoVaTen" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_staff->hoVaTen->getPlaceHolder()) ?>" value="<?php echo $tbl_staff->hoVaTen->EditValue ?>"<?php echo $tbl_staff->hoVaTen->editAttributes() ?>>
</span>
<?php echo $tbl_staff->hoVaTen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_staff->gioiTinh->Visible) { // gioiTinh ?>
	<div id="r_gioiTinh" class="form-group row">
		<label id="elh_tbl_staff_gioiTinh" for="x_gioiTinh" class="<?php echo $tbl_staff_add->LeftColumnClass ?>"><?php echo $tbl_staff->gioiTinh->caption() ?><?php echo ($tbl_staff->gioiTinh->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_staff_add->RightColumnClass ?>"><div<?php echo $tbl_staff->gioiTinh->cellAttributes() ?>>
<span id="el_tbl_staff_gioiTinh">
<input type="text" data-table="tbl_staff" data-field="x_gioiTinh" name="x_gioiTinh" id="x_gioiTinh" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($tbl_staff->gioiTinh->getPlaceHolder()) ?>" value="<?php echo $tbl_staff->gioiTinh->EditValue ?>"<?php echo $tbl_staff->gioiTinh->editAttributes() ?>>
</span>
<?php echo $tbl_staff->gioiTinh->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_staff->ngaySinh->Visible) { // ngaySinh ?>
	<div id="r_ngaySinh" class="form-group row">
		<label id="elh_tbl_staff_ngaySinh" for="x_ngaySinh" class="<?php echo $tbl_staff_add->LeftColumnClass ?>"><?php echo $tbl_staff->ngaySinh->caption() ?><?php echo ($tbl_staff->ngaySinh->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_staff_add->RightColumnClass ?>"><div<?php echo $tbl_staff->ngaySinh->cellAttributes() ?>>
<span id="el_tbl_staff_ngaySinh">
<input type="text" data-table="tbl_staff" data-field="x_ngaySinh" name="x_ngaySinh" id="x_ngaySinh" placeholder="<?php echo HtmlEncode($tbl_staff->ngaySinh->getPlaceHolder()) ?>" value="<?php echo $tbl_staff->ngaySinh->EditValue ?>"<?php echo $tbl_staff->ngaySinh->editAttributes() ?>>
<?php if (!$tbl_staff->ngaySinh->ReadOnly && !$tbl_staff->ngaySinh->Disabled && !isset($tbl_staff->ngaySinh->EditAttrs["readonly"]) && !isset($tbl_staff->ngaySinh->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_staffadd", "x_ngaySinh", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $tbl_staff->ngaySinh->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_staff->emailCaNhan->Visible) { // emailCaNhan ?>
	<div id="r_emailCaNhan" class="form-group row">
		<label id="elh_tbl_staff_emailCaNhan" for="x_emailCaNhan" class="<?php echo $tbl_staff_add->LeftColumnClass ?>"><?php echo $tbl_staff->emailCaNhan->caption() ?><?php echo ($tbl_staff->emailCaNhan->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_staff_add->RightColumnClass ?>"><div<?php echo $tbl_staff->emailCaNhan->cellAttributes() ?>>
<span id="el_tbl_staff_emailCaNhan">
<input type="text" data-table="tbl_staff" data-field="x_emailCaNhan" name="x_emailCaNhan" id="x_emailCaNhan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_staff->emailCaNhan->getPlaceHolder()) ?>" value="<?php echo $tbl_staff->emailCaNhan->EditValue ?>"<?php echo $tbl_staff->emailCaNhan->editAttributes() ?>>
</span>
<?php echo $tbl_staff->emailCaNhan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_staff->CD_ID->Visible) { // CD_ID ?>
	<div id="r_CD_ID" class="form-group row">
		<label id="elh_tbl_staff_CD_ID" for="x_CD_ID" class="<?php echo $tbl_staff_add->LeftColumnClass ?>"><?php echo $tbl_staff->CD_ID->caption() ?><?php echo ($tbl_staff->CD_ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_staff_add->RightColumnClass ?>"><div<?php echo $tbl_staff->CD_ID->cellAttributes() ?>>
<span id="el_tbl_staff_CD_ID">
<input type="text" data-table="tbl_staff" data-field="x_CD_ID" name="x_CD_ID" id="x_CD_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_staff->CD_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_staff->CD_ID->EditValue ?>"<?php echo $tbl_staff->CD_ID->editAttributes() ?>>
</span>
<?php echo $tbl_staff->CD_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_staff->TD_ID->Visible) { // TD_ID ?>
	<div id="r_TD_ID" class="form-group row">
		<label id="elh_tbl_staff_TD_ID" for="x_TD_ID" class="<?php echo $tbl_staff_add->LeftColumnClass ?>"><?php echo $tbl_staff->TD_ID->caption() ?><?php echo ($tbl_staff->TD_ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_staff_add->RightColumnClass ?>"><div<?php echo $tbl_staff->TD_ID->cellAttributes() ?>>
<span id="el_tbl_staff_TD_ID">
<input type="text" data-table="tbl_staff" data-field="x_TD_ID" name="x_TD_ID" id="x_TD_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_staff->TD_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_staff->TD_ID->EditValue ?>"<?php echo $tbl_staff->TD_ID->editAttributes() ?>>
</span>
<?php echo $tbl_staff->TD_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_staff->PB_ID->Visible) { // PB_ID ?>
	<div id="r_PB_ID" class="form-group row">
		<label id="elh_tbl_staff_PB_ID" for="x_PB_ID" class="<?php echo $tbl_staff_add->LeftColumnClass ?>"><?php echo $tbl_staff->PB_ID->caption() ?><?php echo ($tbl_staff->PB_ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_staff_add->RightColumnClass ?>"><div<?php echo $tbl_staff->PB_ID->cellAttributes() ?>>
<span id="el_tbl_staff_PB_ID">
<input type="text" data-table="tbl_staff" data-field="x_PB_ID" name="x_PB_ID" id="x_PB_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_staff->PB_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_staff->PB_ID->EditValue ?>"<?php echo $tbl_staff->PB_ID->editAttributes() ?>>
</span>
<?php echo $tbl_staff->PB_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_staff_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_staff_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_staff_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_staff_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_staff_add->terminate();
?>