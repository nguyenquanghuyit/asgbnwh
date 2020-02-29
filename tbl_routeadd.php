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
$tbl_route_add = new tbl_route_add();

// Run the page
$tbl_route_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_route_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_routeadd = currentForm = new ew.Form("ftbl_routeadd", "add");

// Validate form
ftbl_routeadd.validate = function() {
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
		<?php if ($tbl_route_add->RouteName->Required) { ?>
			elm = this.getElements("x" + infix + "_RouteName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->RouteName->caption(), $tbl_route->RouteName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_add->TruckNo->Required) { ?>
			elm = this.getElements("x" + infix + "_TruckNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->TruckNo->caption(), $tbl_route->TruckNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_add->DriverName->Required) { ?>
			elm = this.getElements("x" + infix + "_DriverName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->DriverName->caption(), $tbl_route->DriverName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_add->DriverMobile->Required) { ?>
			elm = this.getElements("x" + infix + "_DriverMobile");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->DriverMobile->caption(), $tbl_route->DriverMobile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_add->InvoiceNo->Required) { ?>
			elm = this.getElements("x" + infix + "_InvoiceNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->InvoiceNo->caption(), $tbl_route->InvoiceNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_add->InvoiceDate->Required) { ?>
			elm = this.getElements("x" + infix + "_InvoiceDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->InvoiceDate->caption(), $tbl_route->InvoiceDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_InvoiceDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_route->InvoiceDate->errorMessage()) ?>");
		<?php if ($tbl_route_add->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->CreateUser->caption(), $tbl_route->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_add->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->CreateDate->caption(), $tbl_route->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_route->CreateDate->errorMessage()) ?>");
		<?php if ($tbl_route_add->AttachFile->Required) { ?>
			felm = this.getElements("x" + infix + "_AttachFile");
			elm = this.getElements("fn_x" + infix + "_AttachFile");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $tbl_route->AttachFile->caption(), $tbl_route->AttachFile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_add->LoadingID->Required) { ?>
			elm = this.getElements("x" + infix + "_LoadingID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_route->LoadingID->caption(), $tbl_route->LoadingID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_route_add->Id_Type->Required) { ?>
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
ftbl_routeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_routeadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_routeadd.lists["x_RouteName"] = <?php echo $tbl_route_add->RouteName->Lookup->toClientList() ?>;
ftbl_routeadd.lists["x_RouteName"].options = <?php echo JsonEncode($tbl_route_add->RouteName->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_route_add->showPageHeader(); ?>
<?php
$tbl_route_add->showMessage();
?>
<form name="ftbl_routeadd" id="ftbl_routeadd" class="<?php echo $tbl_route_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_route_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_route_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_route">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_route_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_route->RouteName->Visible) { // RouteName ?>
	<div id="r_RouteName" class="form-group row">
		<label id="elh_tbl_route_RouteName" for="x_RouteName" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->RouteName->caption() ?><?php echo ($tbl_route->RouteName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->RouteName->cellAttributes() ?>>
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
		<label id="elh_tbl_route_TruckNo" for="x_TruckNo" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->TruckNo->caption() ?><?php echo ($tbl_route->TruckNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->TruckNo->cellAttributes() ?>>
<span id="el_tbl_route_TruckNo">
<input type="text" data-table="tbl_route" data-field="x_TruckNo" name="x_TruckNo" id="x_TruckNo" size="20" maxlength="25" placeholder="<?php echo HtmlEncode($tbl_route->TruckNo->getPlaceHolder()) ?>" value="<?php echo $tbl_route->TruckNo->EditValue ?>"<?php echo $tbl_route->TruckNo->editAttributes() ?>>
</span>
<?php echo $tbl_route->TruckNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->DriverName->Visible) { // DriverName ?>
	<div id="r_DriverName" class="form-group row">
		<label id="elh_tbl_route_DriverName" for="x_DriverName" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->DriverName->caption() ?><?php echo ($tbl_route->DriverName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->DriverName->cellAttributes() ?>>
<span id="el_tbl_route_DriverName">
<input type="text" data-table="tbl_route" data-field="x_DriverName" name="x_DriverName" id="x_DriverName" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($tbl_route->DriverName->getPlaceHolder()) ?>" value="<?php echo $tbl_route->DriverName->EditValue ?>"<?php echo $tbl_route->DriverName->editAttributes() ?>>
</span>
<?php echo $tbl_route->DriverName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->DriverMobile->Visible) { // DriverMobile ?>
	<div id="r_DriverMobile" class="form-group row">
		<label id="elh_tbl_route_DriverMobile" for="x_DriverMobile" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->DriverMobile->caption() ?><?php echo ($tbl_route->DriverMobile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->DriverMobile->cellAttributes() ?>>
<span id="el_tbl_route_DriverMobile">
<input type="text" data-table="tbl_route" data-field="x_DriverMobile" name="x_DriverMobile" id="x_DriverMobile" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($tbl_route->DriverMobile->getPlaceHolder()) ?>" value="<?php echo $tbl_route->DriverMobile->EditValue ?>"<?php echo $tbl_route->DriverMobile->editAttributes() ?>>
</span>
<?php echo $tbl_route->DriverMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->InvoiceNo->Visible) { // InvoiceNo ?>
	<div id="r_InvoiceNo" class="form-group row">
		<label id="elh_tbl_route_InvoiceNo" for="x_InvoiceNo" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->InvoiceNo->caption() ?><?php echo ($tbl_route->InvoiceNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->InvoiceNo->cellAttributes() ?>>
<span id="el_tbl_route_InvoiceNo">
<input type="text" data-table="tbl_route" data-field="x_InvoiceNo" name="x_InvoiceNo" id="x_InvoiceNo" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_route->InvoiceNo->getPlaceHolder()) ?>" value="<?php echo $tbl_route->InvoiceNo->EditValue ?>"<?php echo $tbl_route->InvoiceNo->editAttributes() ?>>
</span>
<?php echo $tbl_route->InvoiceNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->InvoiceDate->Visible) { // InvoiceDate ?>
	<div id="r_InvoiceDate" class="form-group row">
		<label id="elh_tbl_route_InvoiceDate" for="x_InvoiceDate" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->InvoiceDate->caption() ?><?php echo ($tbl_route->InvoiceDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->InvoiceDate->cellAttributes() ?>>
<span id="el_tbl_route_InvoiceDate">
<input type="text" data-table="tbl_route" data-field="x_InvoiceDate" data-format="7" name="x_InvoiceDate" id="x_InvoiceDate" placeholder="<?php echo HtmlEncode($tbl_route->InvoiceDate->getPlaceHolder()) ?>" value="<?php echo $tbl_route->InvoiceDate->EditValue ?>"<?php echo $tbl_route->InvoiceDate->editAttributes() ?>>
<?php if (!$tbl_route->InvoiceDate->ReadOnly && !$tbl_route->InvoiceDate->Disabled && !isset($tbl_route->InvoiceDate->EditAttrs["readonly"]) && !isset($tbl_route->InvoiceDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_routeadd", "x_InvoiceDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $tbl_route->InvoiceDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->CreateUser->Visible) { // CreateUser ?>
	<div id="r_CreateUser" class="form-group row">
		<label id="elh_tbl_route_CreateUser" for="x_CreateUser" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->CreateUser->caption() ?><?php echo ($tbl_route->CreateUser->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->CreateUser->cellAttributes() ?>>
<span id="el_tbl_route_CreateUser">
<input type="text" data-table="tbl_route" data-field="x_CreateUser" name="x_CreateUser" id="x_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_route->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_route->CreateUser->EditValue ?>"<?php echo $tbl_route->CreateUser->editAttributes() ?>>
</span>
<?php echo $tbl_route->CreateUser->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->CreateDate->Visible) { // CreateDate ?>
	<div id="r_CreateDate" class="form-group row">
		<label id="elh_tbl_route_CreateDate" for="x_CreateDate" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->CreateDate->caption() ?><?php echo ($tbl_route->CreateDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->CreateDate->cellAttributes() ?>>
<span id="el_tbl_route_CreateDate">
<input type="text" data-table="tbl_route" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($tbl_route->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_route->CreateDate->EditValue ?>"<?php echo $tbl_route->CreateDate->editAttributes() ?>>
<?php if (!$tbl_route->CreateDate->ReadOnly && !$tbl_route->CreateDate->Disabled && !isset($tbl_route->CreateDate->EditAttrs["readonly"]) && !isset($tbl_route->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_routeadd", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php echo $tbl_route->CreateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->AttachFile->Visible) { // AttachFile ?>
	<div id="r_AttachFile" class="form-group row">
		<label id="elh_tbl_route_AttachFile" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->AttachFile->caption() ?><?php echo ($tbl_route->AttachFile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->AttachFile->cellAttributes() ?>>
<span id="el_tbl_route_AttachFile">
<div id="fd_x_AttachFile">
<span title="<?php echo $tbl_route->AttachFile->title() ? $tbl_route->AttachFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($tbl_route->AttachFile->ReadOnly || $tbl_route->AttachFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="tbl_route" data-field="x_AttachFile" name="x_AttachFile" id="x_AttachFile"<?php echo $tbl_route->AttachFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_AttachFile" id= "fn_x_AttachFile" value="<?php echo $tbl_route->AttachFile->Upload->FileName ?>">
<input type="hidden" name="fa_x_AttachFile" id= "fa_x_AttachFile" value="0">
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
		<label id="elh_tbl_route_LoadingID" for="x_LoadingID" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->LoadingID->caption() ?><?php echo ($tbl_route->LoadingID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->LoadingID->cellAttributes() ?>>
<span id="el_tbl_route_LoadingID">
<input type="text" data-table="tbl_route" data-field="x_LoadingID" name="x_LoadingID" id="x_LoadingID" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_route->LoadingID->getPlaceHolder()) ?>" value="<?php echo $tbl_route->LoadingID->EditValue ?>"<?php echo $tbl_route->LoadingID->editAttributes() ?>>
</span>
<?php echo $tbl_route->LoadingID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_route->Id_Type->Visible) { // Id_Type ?>
	<div id="r_Id_Type" class="form-group row">
		<label id="elh_tbl_route_Id_Type" for="x_Id_Type" class="<?php echo $tbl_route_add->LeftColumnClass ?>"><?php echo $tbl_route->Id_Type->caption() ?><?php echo ($tbl_route->Id_Type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_route_add->RightColumnClass ?>"><div<?php echo $tbl_route->Id_Type->cellAttributes() ?>>
<span id="el_tbl_route_Id_Type">
<input type="text" data-table="tbl_route" data-field="x_Id_Type" name="x_Id_Type" id="x_Id_Type" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($tbl_route->Id_Type->getPlaceHolder()) ?>" value="<?php echo $tbl_route->Id_Type->EditValue ?>"<?php echo $tbl_route->Id_Type->editAttributes() ?>>
</span>
<?php echo $tbl_route->Id_Type->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("vwRouteUnload", explode(",", $tbl_route->getCurrentDetailTable())) && $vwRouteUnload->DetailAdd) {
?>
<?php if ($tbl_route->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("vwRouteUnload", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "vwRouteUnloadgrid.php" ?>
<?php } ?>
<?php if (!$tbl_route_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_route_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_route_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_route_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_route_add->terminate();
?>