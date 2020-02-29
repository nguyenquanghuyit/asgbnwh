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
$tbl_route_edit = new tbl_route_edit();

// Run the page
$tbl_route_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_route_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftbl_routeedit = currentForm = new ew.Form("ftbl_routeedit", "edit");

// Validate form
ftbl_routeedit.validate = function() {
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
		<?php if ($tbl_route_edit->RouteName->Required) { ?>
			elm = this.getElements("x" + infix + "_RouteName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->RouteName->caption(), $tbl_route->RouteName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_edit->TruckNo->Required) { ?>
			elm = this.getElements("x" + infix + "_TruckNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->TruckNo->caption(), $tbl_route->TruckNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_edit->DriverName->Required) { ?>
			elm = this.getElements("x" + infix + "_DriverName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->DriverName->caption(), $tbl_route->DriverName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_edit->DriverMobile->Required) { ?>
			elm = this.getElements("x" + infix + "_DriverMobile");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->DriverMobile->caption(), $tbl_route->DriverMobile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_edit->FinishUnload->Required) { ?>
			elm = this.getElements("x" + infix + "_FinishUnload");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->FinishUnload->caption(), $tbl_route->FinishUnload->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_edit->SealNo->Required) { ?>
			elm = this.getElements("x" + infix + "_SealNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->SealNo->caption(), $tbl_route->SealNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_edit->AttachFile->Required) { ?>
			felm = this.getElements("x" + infix + "_AttachFile");
			elm = this.getElements("fn_x" + infix + "_AttachFile");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $tbl_route->AttachFile->caption(), $tbl_route->AttachFile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_edit->LoadingID->Required) { ?>
			elm = this.getElements("x" + infix + "_LoadingID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->LoadingID->caption(), $tbl_route->LoadingID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_edit->Id_Type->Required) { ?>
			elm = this.getElements("x" + infix + "_Id_Type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->Id_Type->caption(), $tbl_route->Id_Type->RequiredErrorMessage)) ?>");
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
ftbl_routeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_routeedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_routeedit.lists["x_RouteName"] = <?php echo $tbl_route_edit->RouteName->Lookup->toClientList() ?>;
ftbl_routeedit.lists["x_RouteName"].options = <?php echo JsonEncode($tbl_route_edit->RouteName->options(FALSE, TRUE)) ?>;
ftbl_routeedit.lists["x_FinishUnload"] = <?php echo $tbl_route_edit->FinishUnload->Lookup->toClientList() ?>;
ftbl_routeedit.lists["x_FinishUnload"].options = <?php echo JsonEncode($tbl_route_edit->FinishUnload->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_route_edit->showPageHeader(); ?>
<?php
$tbl_route_edit->showMessage();
?>
<form name="ftbl_routeedit" id="ftbl_routeedit" class="<?php echo $tbl_route_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_route_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_route_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_route">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_route_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_route->RouteName->Visible) { // RouteName ?>
	<div id="r_RouteName" class="form-group row">
		<label id="elh_tbl_route_RouteName" for="x_RouteName" class="<?php echo $tbl_route_edit->LeftColumnClass ?>"><?php echo $tbl_route->RouteName->caption() ?><?php echo ($tbl_route->RouteName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_edit->RightColumnClass ?>"><div<?php echo $tbl_route->RouteName->cellAttributes() ?>>
<span id="el_tbl_route_RouteName">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_route" data-field="x_RouteName" data-value-separator="<?php echo $tbl_route->RouteName->displayValueSeparatorAttribute() ?>" id="x_RouteName" name="x_RouteName"<?php echo $tbl_route->RouteName->editAttributes() ?>>
		<?php echo $tbl_route->RouteName->selectOptionListHtml("x_RouteName") ?>
	</select>
</div>
</span>
<?php echo $tbl_route->RouteName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->TruckNo->Visible) { // TruckNo ?>
	<div id="r_TruckNo" class="form-group row">
		<label id="elh_tbl_route_TruckNo" for="x_TruckNo" class="<?php echo $tbl_route_edit->LeftColumnClass ?>"><?php echo $tbl_route->TruckNo->caption() ?><?php echo ($tbl_route->TruckNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_edit->RightColumnClass ?>"><div<?php echo $tbl_route->TruckNo->cellAttributes() ?>>
<span id="el_tbl_route_TruckNo">
<input type="text" data-table="tbl_route" data-field="x_TruckNo" name="x_TruckNo" id="x_TruckNo" size="20" maxlength="25" placeholder="<?php echo HtmlEncode($tbl_route->TruckNo->getPlaceHolder()) ?>" value="<?php echo $tbl_route->TruckNo->EditValue ?>"<?php echo $tbl_route->TruckNo->editAttributes() ?>>
</span>
<?php echo $tbl_route->TruckNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->DriverName->Visible) { // DriverName ?>
	<div id="r_DriverName" class="form-group row">
		<label id="elh_tbl_route_DriverName" for="x_DriverName" class="<?php echo $tbl_route_edit->LeftColumnClass ?>"><?php echo $tbl_route->DriverName->caption() ?><?php echo ($tbl_route->DriverName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_edit->RightColumnClass ?>"><div<?php echo $tbl_route->DriverName->cellAttributes() ?>>
<span id="el_tbl_route_DriverName">
<input type="text" data-table="tbl_route" data-field="x_DriverName" name="x_DriverName" id="x_DriverName" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($tbl_route->DriverName->getPlaceHolder()) ?>" value="<?php echo $tbl_route->DriverName->EditValue ?>"<?php echo $tbl_route->DriverName->editAttributes() ?>>
</span>
<?php echo $tbl_route->DriverName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->DriverMobile->Visible) { // DriverMobile ?>
	<div id="r_DriverMobile" class="form-group row">
		<label id="elh_tbl_route_DriverMobile" for="x_DriverMobile" class="<?php echo $tbl_route_edit->LeftColumnClass ?>"><?php echo $tbl_route->DriverMobile->caption() ?><?php echo ($tbl_route->DriverMobile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_edit->RightColumnClass ?>"><div<?php echo $tbl_route->DriverMobile->cellAttributes() ?>>
<span id="el_tbl_route_DriverMobile">
<input type="text" data-table="tbl_route" data-field="x_DriverMobile" name="x_DriverMobile" id="x_DriverMobile" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($tbl_route->DriverMobile->getPlaceHolder()) ?>" value="<?php echo $tbl_route->DriverMobile->EditValue ?>"<?php echo $tbl_route->DriverMobile->editAttributes() ?>>
</span>
<?php echo $tbl_route->DriverMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->FinishUnload->Visible) { // FinishUnload ?>
	<div id="r_FinishUnload" class="form-group row">
		<label id="elh_tbl_route_FinishUnload" for="x_FinishUnload" class="<?php echo $tbl_route_edit->LeftColumnClass ?>"><?php echo $tbl_route->FinishUnload->caption() ?><?php echo ($tbl_route->FinishUnload->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_edit->RightColumnClass ?>"><div<?php echo $tbl_route->FinishUnload->cellAttributes() ?>>
<span id="el_tbl_route_FinishUnload">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_route" data-field="x_FinishUnload" data-value-separator="<?php echo $tbl_route->FinishUnload->displayValueSeparatorAttribute() ?>" id="x_FinishUnload" name="x_FinishUnload"<?php echo $tbl_route->FinishUnload->editAttributes() ?>>
		<?php echo $tbl_route->FinishUnload->selectOptionListHtml("x_FinishUnload") ?>
	</select>
</div>
</span>
<?php echo $tbl_route->FinishUnload->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->SealNo->Visible) { // SealNo ?>
	<div id="r_SealNo" class="form-group row">
		<label id="elh_tbl_route_SealNo" for="x_SealNo" class="<?php echo $tbl_route_edit->LeftColumnClass ?>"><?php echo $tbl_route->SealNo->caption() ?><?php echo ($tbl_route->SealNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_edit->RightColumnClass ?>"><div<?php echo $tbl_route->SealNo->cellAttributes() ?>>
<span id="el_tbl_route_SealNo">
<input type="text" data-table="tbl_route" data-field="x_SealNo" name="x_SealNo" id="x_SealNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_route->SealNo->getPlaceHolder()) ?>" value="<?php echo $tbl_route->SealNo->EditValue ?>"<?php echo $tbl_route->SealNo->editAttributes() ?>>
</span>
<?php echo $tbl_route->SealNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->AttachFile->Visible) { // AttachFile ?>
	<div id="r_AttachFile" class="form-group row">
		<label id="elh_tbl_route_AttachFile" class="<?php echo $tbl_route_edit->LeftColumnClass ?>"><?php echo $tbl_route->AttachFile->caption() ?><?php echo ($tbl_route->AttachFile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_edit->RightColumnClass ?>"><div<?php echo $tbl_route->AttachFile->cellAttributes() ?>>
<span id="el_tbl_route_AttachFile">
<div id="fd_x_AttachFile">
<span title="<?php echo $tbl_route->AttachFile->title() ? $tbl_route->AttachFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($tbl_route->AttachFile->ReadOnly || $tbl_route->AttachFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="tbl_route" data-field="x_AttachFile" name="x_AttachFile" id="x_AttachFile"<?php echo $tbl_route->AttachFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_AttachFile" id= "fn_x_AttachFile" value="<?php echo $tbl_route->AttachFile->Upload->FileName ?>">
<?php if (Post("fa_x_AttachFile") == "0") { ?>
<input type="hidden" name="fa_x_AttachFile" id= "fa_x_AttachFile" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_AttachFile" id= "fa_x_AttachFile" value="1">
<?php } ?>
<input type="hidden" name="fs_x_AttachFile" id= "fs_x_AttachFile" value="255">
<input type="hidden" name="fx_x_AttachFile" id= "fx_x_AttachFile" value="<?php echo $tbl_route->AttachFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_AttachFile" id= "fm_x_AttachFile" value="<?php echo $tbl_route->AttachFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x_AttachFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $tbl_route->AttachFile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->LoadingID->Visible) { // LoadingID ?>
	<div id="r_LoadingID" class="form-group row">
		<label id="elh_tbl_route_LoadingID" for="x_LoadingID" class="<?php echo $tbl_route_edit->LeftColumnClass ?>"><?php echo $tbl_route->LoadingID->caption() ?><?php echo ($tbl_route->LoadingID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_edit->RightColumnClass ?>"><div<?php echo $tbl_route->LoadingID->cellAttributes() ?>>
<span id="el_tbl_route_LoadingID">
<input type="text" data-table="tbl_route" data-field="x_LoadingID" name="x_LoadingID" id="x_LoadingID" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_route->LoadingID->getPlaceHolder()) ?>" value="<?php echo $tbl_route->LoadingID->EditValue ?>"<?php echo $tbl_route->LoadingID->editAttributes() ?>>
</span>
<?php echo $tbl_route->LoadingID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->Id_Type->Visible) { // Id_Type ?>
	<div id="r_Id_Type" class="form-group row">
		<label id="elh_tbl_route_Id_Type" for="x_Id_Type" class="<?php echo $tbl_route_edit->LeftColumnClass ?>"><?php echo $tbl_route->Id_Type->caption() ?><?php echo ($tbl_route->Id_Type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_edit->RightColumnClass ?>"><div<?php echo $tbl_route->Id_Type->cellAttributes() ?>>
<span id="el_tbl_route_Id_Type">
<input type="text" data-table="tbl_route" data-field="x_Id_Type" name="x_Id_Type" id="x_Id_Type" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($tbl_route->Id_Type->getPlaceHolder()) ?>" value="<?php echo $tbl_route->Id_Type->EditValue ?>"<?php echo $tbl_route->Id_Type->editAttributes() ?>>
</span>
<?php echo $tbl_route->Id_Type->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="tbl_route" data-field="x_ID_Route" name="x_ID_Route" id="x_ID_Route" value="<?php echo HtmlEncode($tbl_route->ID_Route->CurrentValue) ?>">
<?php
	if (in_array("vwRouteUnload", explode(",", $tbl_route->getCurrentDetailTable())) && $vwRouteUnload->DetailEdit) {
?>
<?php if ($tbl_route->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("vwRouteUnload", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "vwRouteUnloadgrid.php" ?>
<?php } ?>
<?php if (!$tbl_route_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_route_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_route_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_route_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_route_edit->terminate();
?>