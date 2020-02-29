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
$tbl_pallet_edit = new tbl_pallet_edit();

// Run the page
$tbl_pallet_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pallet_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftbl_palletedit = currentForm = new ew.Form("ftbl_palletedit", "edit");

// Validate form
ftbl_palletedit.validate = function() {
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
		<?php if ($tbl_pallet_edit->ID_Route->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Route");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->ID_Route->caption(), $tbl_pallet->ID_Route->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_pallet_edit->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->PalletID->caption(), $tbl_pallet->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_pallet_edit->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->Code->caption(), $tbl_pallet->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_pallet_edit->Id_Type->Required) { ?>
			elm = this.getElements("x" + infix + "_Id_Type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->Id_Type->caption(), $tbl_pallet->Id_Type->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_pallet_edit->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->PCS->caption(), $tbl_pallet->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_pallet->PCS->errorMessage()) ?>");
		<?php if ($tbl_pallet_edit->ExistStatus->Required) { ?>
			elm = this.getElements("x" + infix + "_ExistStatus");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->ExistStatus->caption(), $tbl_pallet->ExistStatus->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_pallet_edit->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->CreateUser->caption(), $tbl_pallet->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_pallet_edit->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->CreateDate->caption(), $tbl_pallet->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_pallet_edit->PenddingStatus->Required) { ?>
			elm = this.getElements("x" + infix + "_PenddingStatus");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->PenddingStatus->caption(), $tbl_pallet->PenddingStatus->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_pallet_edit->UserFinishPendding->Required) { ?>
			elm = this.getElements("x" + infix + "_UserFinishPendding");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->UserFinishPendding->caption(), $tbl_pallet->UserFinishPendding->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_pallet_edit->DateTimeFinishPedding->Required) { ?>
			elm = this.getElements("x" + infix + "_DateTimeFinishPedding");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pallet->DateTimeFinishPedding->caption(), $tbl_pallet->DateTimeFinishPedding->RequiredErrorMessage)) ?>");
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
ftbl_palletedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_palletedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_palletedit.lists["x_ID_Route"] = <?php echo $tbl_pallet_edit->ID_Route->Lookup->toClientList() ?>;
ftbl_palletedit.lists["x_ID_Route"].options = <?php echo JsonEncode($tbl_pallet_edit->ID_Route->lookupOptions()) ?>;
ftbl_palletedit.lists["x_Id_Type"] = <?php echo $tbl_pallet_edit->Id_Type->Lookup->toClientList() ?>;
ftbl_palletedit.lists["x_Id_Type"].options = <?php echo JsonEncode($tbl_pallet_edit->Id_Type->lookupOptions()) ?>;
ftbl_palletedit.lists["x_ExistStatus"] = <?php echo $tbl_pallet_edit->ExistStatus->Lookup->toClientList() ?>;
ftbl_palletedit.lists["x_ExistStatus"].options = <?php echo JsonEncode($tbl_pallet_edit->ExistStatus->options(FALSE, TRUE)) ?>;
ftbl_palletedit.lists["x_PenddingStatus"] = <?php echo $tbl_pallet_edit->PenddingStatus->Lookup->toClientList() ?>;
ftbl_palletedit.lists["x_PenddingStatus"].options = <?php echo JsonEncode($tbl_pallet_edit->PenddingStatus->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_pallet_edit->showPageHeader(); ?>
<?php
$tbl_pallet_edit->showMessage();
?>
<form name="ftbl_palletedit" id="ftbl_palletedit" class="<?php echo $tbl_pallet_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_pallet_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_pallet_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pallet">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_pallet_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_pallet->ID_Route->Visible) { // ID_Route ?>
	<div id="r_ID_Route" class="form-group row">
		<label id="elh_tbl_pallet_ID_Route" for="x_ID_Route" class="<?php echo $tbl_pallet_edit->LeftColumnClass ?>"><?php echo $tbl_pallet->ID_Route->caption() ?><?php echo ($tbl_pallet->ID_Route->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pallet_edit->RightColumnClass ?>"><div<?php echo $tbl_pallet->ID_Route->cellAttributes() ?>>
<span id="el_tbl_pallet_ID_Route">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pallet" data-field="x_ID_Route" data-value-separator="<?php echo $tbl_pallet->ID_Route->displayValueSeparatorAttribute() ?>" id="x_ID_Route" name="x_ID_Route"<?php echo $tbl_pallet->ID_Route->editAttributes() ?>>
		<?php echo $tbl_pallet->ID_Route->selectOptionListHtml("x_ID_Route") ?>
	</select>
</div>
<?php echo $tbl_pallet->ID_Route->Lookup->getParamTag("p_x_ID_Route") ?>
</span>
<?php echo $tbl_pallet->ID_Route->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pallet->PalletID->Visible) { // PalletID ?>
	<div id="r_PalletID" class="form-group row">
		<label id="elh_tbl_pallet_PalletID" for="x_PalletID" class="<?php echo $tbl_pallet_edit->LeftColumnClass ?>"><?php echo $tbl_pallet->PalletID->caption() ?><?php echo ($tbl_pallet->PalletID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pallet_edit->RightColumnClass ?>"><div<?php echo $tbl_pallet->PalletID->cellAttributes() ?>>
<span id="el_tbl_pallet_PalletID">
<input type="text" data-table="tbl_pallet" data-field="x_PalletID" name="x_PalletID" id="x_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_pallet->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_pallet->PalletID->EditValue ?>"<?php echo $tbl_pallet->PalletID->editAttributes() ?>>
</span>
<?php echo $tbl_pallet->PalletID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pallet->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label id="elh_tbl_pallet_Code" for="x_Code" class="<?php echo $tbl_pallet_edit->LeftColumnClass ?>"><?php echo $tbl_pallet->Code->caption() ?><?php echo ($tbl_pallet->Code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pallet_edit->RightColumnClass ?>"><div<?php echo $tbl_pallet->Code->cellAttributes() ?>>
<span id="el_tbl_pallet_Code">
<input type="text" data-table="tbl_pallet" data-field="x_Code" name="x_Code" id="x_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_pallet->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_pallet->Code->EditValue ?>"<?php echo $tbl_pallet->Code->editAttributes() ?>>
</span>
<?php echo $tbl_pallet->Code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pallet->Id_Type->Visible) { // Id_Type ?>
	<div id="r_Id_Type" class="form-group row">
		<label id="elh_tbl_pallet_Id_Type" for="x_Id_Type" class="<?php echo $tbl_pallet_edit->LeftColumnClass ?>"><?php echo $tbl_pallet->Id_Type->caption() ?><?php echo ($tbl_pallet->Id_Type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pallet_edit->RightColumnClass ?>"><div<?php echo $tbl_pallet->Id_Type->cellAttributes() ?>>
<span id="el_tbl_pallet_Id_Type">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pallet" data-field="x_Id_Type" data-value-separator="<?php echo $tbl_pallet->Id_Type->displayValueSeparatorAttribute() ?>" id="x_Id_Type" name="x_Id_Type"<?php echo $tbl_pallet->Id_Type->editAttributes() ?>>
		<?php echo $tbl_pallet->Id_Type->selectOptionListHtml("x_Id_Type") ?>
	</select>
</div>
<?php echo $tbl_pallet->Id_Type->Lookup->getParamTag("p_x_Id_Type") ?>
</span>
<?php echo $tbl_pallet->Id_Type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pallet->PCS->Visible) { // PCS ?>
	<div id="r_PCS" class="form-group row">
		<label id="elh_tbl_pallet_PCS" for="x_PCS" class="<?php echo $tbl_pallet_edit->LeftColumnClass ?>"><?php echo $tbl_pallet->PCS->caption() ?><?php echo ($tbl_pallet->PCS->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pallet_edit->RightColumnClass ?>"><div<?php echo $tbl_pallet->PCS->cellAttributes() ?>>
<span id="el_tbl_pallet_PCS">
<input type="text" data-table="tbl_pallet" data-field="x_PCS" name="x_PCS" id="x_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_pallet->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_pallet->PCS->EditValue ?>"<?php echo $tbl_pallet->PCS->editAttributes() ?>>
</span>
<?php echo $tbl_pallet->PCS->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pallet->ExistStatus->Visible) { // ExistStatus ?>
	<div id="r_ExistStatus" class="form-group row">
		<label id="elh_tbl_pallet_ExistStatus" for="x_ExistStatus" class="<?php echo $tbl_pallet_edit->LeftColumnClass ?>"><?php echo $tbl_pallet->ExistStatus->caption() ?><?php echo ($tbl_pallet->ExistStatus->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pallet_edit->RightColumnClass ?>"><div<?php echo $tbl_pallet->ExistStatus->cellAttributes() ?>>
<span id="el_tbl_pallet_ExistStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pallet" data-field="x_ExistStatus" data-value-separator="<?php echo $tbl_pallet->ExistStatus->displayValueSeparatorAttribute() ?>" id="x_ExistStatus" name="x_ExistStatus"<?php echo $tbl_pallet->ExistStatus->editAttributes() ?>>
		<?php echo $tbl_pallet->ExistStatus->selectOptionListHtml("x_ExistStatus") ?>
	</select>
</div>
</span>
<?php echo $tbl_pallet->ExistStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pallet->PenddingStatus->Visible) { // PenddingStatus ?>
	<div id="r_PenddingStatus" class="form-group row">
		<label id="elh_tbl_pallet_PenddingStatus" for="x_PenddingStatus" class="<?php echo $tbl_pallet_edit->LeftColumnClass ?>"><?php echo $tbl_pallet->PenddingStatus->caption() ?><?php echo ($tbl_pallet->PenddingStatus->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pallet_edit->RightColumnClass ?>"><div<?php echo $tbl_pallet->PenddingStatus->cellAttributes() ?>>
<span id="el_tbl_pallet_PenddingStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pallet" data-field="x_PenddingStatus" data-value-separator="<?php echo $tbl_pallet->PenddingStatus->displayValueSeparatorAttribute() ?>" id="x_PenddingStatus" name="x_PenddingStatus"<?php echo $tbl_pallet->PenddingStatus->editAttributes() ?>>
		<?php echo $tbl_pallet->PenddingStatus->selectOptionListHtml("x_PenddingStatus") ?>
	</select>
</div>
</span>
<?php echo $tbl_pallet->PenddingStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="tbl_pallet" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($tbl_pallet->ID->CurrentValue) ?>">
<?php if (!$tbl_pallet_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_pallet_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_pallet_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_pallet_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_pallet_edit->terminate();
?>