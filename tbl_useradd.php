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
$tbl_user_add = new tbl_user_add();

// Run the page
$tbl_user_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_user_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_useradd = currentForm = new ew.Form("ftbl_useradd", "add");

// Validate form
ftbl_useradd.validate = function() {
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
		<?php if ($tbl_user_add->ma_NV->Required) { ?>
			elm = this.getElements("x" + infix + "_ma_NV");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->ma_NV->caption(), $tbl_user->ma_NV->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_user_add->user_Name->Required) { ?>
			elm = this.getElements("x" + infix + "_user_Name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->user_Name->caption(), $tbl_user->user_Name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_user_add->pass->Required) { ?>
			elm = this.getElements("x" + infix + "_pass");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->pass->caption(), $tbl_user->pass->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_user_add->userLevel->Required) { ?>
			elm = this.getElements("x" + infix + "_userLevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->userLevel->caption(), $tbl_user->userLevel->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_user_add->PB_ID->Required) { ?>
			elm = this.getElements("x" + infix + "_PB_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->PB_ID->caption(), $tbl_user->PB_ID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PB_ID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_user->PB_ID->errorMessage()) ?>");
		<?php if ($tbl_user_add->TD_ID->Required) { ?>
			elm = this.getElements("x" + infix + "_TD_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->TD_ID->caption(), $tbl_user->TD_ID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_TD_ID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_user->TD_ID->errorMessage()) ?>");
		<?php if ($tbl_user_add->CD_ID->Required) { ?>
			elm = this.getElements("x" + infix + "_CD_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->CD_ID->caption(), $tbl_user->CD_ID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CD_ID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_user->CD_ID->errorMessage()) ?>");

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
ftbl_useradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_useradd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_useradd.lists["x_userLevel"] = <?php echo $tbl_user_add->userLevel->Lookup->toClientList() ?>;
ftbl_useradd.lists["x_userLevel"].options = <?php echo JsonEncode($tbl_user_add->userLevel->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_user_add->showPageHeader(); ?>
<?php
$tbl_user_add->showMessage();
?>
<form name="ftbl_useradd" id="ftbl_useradd" class="<?php echo $tbl_user_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_user_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_user_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_user">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_user_add->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_user->ma_NV->Visible) { // ma_NV ?>
	<div id="r_ma_NV" class="form-group row">
		<label id="elh_tbl_user_ma_NV" for="x_ma_NV" class="<?php echo $tbl_user_add->LeftColumnClass ?>"><?php echo $tbl_user->ma_NV->caption() ?><?php echo ($tbl_user->ma_NV->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_user_add->RightColumnClass ?>"><div<?php echo $tbl_user->ma_NV->cellAttributes() ?>>
<span id="el_tbl_user_ma_NV">
<input type="text" data-table="tbl_user" data-field="x_ma_NV" name="x_ma_NV" id="x_ma_NV" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_user->ma_NV->getPlaceHolder()) ?>" value="<?php echo $tbl_user->ma_NV->EditValue ?>"<?php echo $tbl_user->ma_NV->editAttributes() ?>>
</span>
<?php echo $tbl_user->ma_NV->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_user->user_Name->Visible) { // user_Name ?>
	<div id="r_user_Name" class="form-group row">
		<label id="elh_tbl_user_user_Name" for="x_user_Name" class="<?php echo $tbl_user_add->LeftColumnClass ?>"><?php echo $tbl_user->user_Name->caption() ?><?php echo ($tbl_user->user_Name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_user_add->RightColumnClass ?>"><div<?php echo $tbl_user->user_Name->cellAttributes() ?>>
<span id="el_tbl_user_user_Name">
<input type="text" data-table="tbl_user" data-field="x_user_Name" name="x_user_Name" id="x_user_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_user->user_Name->getPlaceHolder()) ?>" value="<?php echo $tbl_user->user_Name->EditValue ?>"<?php echo $tbl_user->user_Name->editAttributes() ?>>
</span>
<?php echo $tbl_user->user_Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_user->pass->Visible) { // pass ?>
	<div id="r_pass" class="form-group row">
		<label id="elh_tbl_user_pass" for="x_pass" class="<?php echo $tbl_user_add->LeftColumnClass ?>"><?php echo $tbl_user->pass->caption() ?><?php echo ($tbl_user->pass->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_user_add->RightColumnClass ?>"><div<?php echo $tbl_user->pass->cellAttributes() ?>>
<span id="el_tbl_user_pass">
<input type="text" data-table="tbl_user" data-field="x_pass" name="x_pass" id="x_pass" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_user->pass->getPlaceHolder()) ?>" value="<?php echo $tbl_user->pass->EditValue ?>"<?php echo $tbl_user->pass->editAttributes() ?>>
</span>
<?php echo $tbl_user->pass->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_user->userLevel->Visible) { // userLevel ?>
	<div id="r_userLevel" class="form-group row">
		<label id="elh_tbl_user_userLevel" for="x_userLevel" class="<?php echo $tbl_user_add->LeftColumnClass ?>"><?php echo $tbl_user->userLevel->caption() ?><?php echo ($tbl_user->userLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_user_add->RightColumnClass ?>"><div<?php echo $tbl_user->userLevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_tbl_user_userLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_user->userLevel->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el_tbl_user_userLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_user" data-field="x_userLevel" data-value-separator="<?php echo $tbl_user->userLevel->displayValueSeparatorAttribute() ?>" id="x_userLevel" name="x_userLevel"<?php echo $tbl_user->userLevel->editAttributes() ?>>
		<?php echo $tbl_user->userLevel->selectOptionListHtml("x_userLevel") ?>
	</select>
</div>
<?php echo $tbl_user->userLevel->Lookup->getParamTag("p_x_userLevel") ?>
</span>
<?php } ?>
<?php echo $tbl_user->userLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_user->PB_ID->Visible) { // PB_ID ?>
	<div id="r_PB_ID" class="form-group row">
		<label id="elh_tbl_user_PB_ID" for="x_PB_ID" class="<?php echo $tbl_user_add->LeftColumnClass ?>"><?php echo $tbl_user->PB_ID->caption() ?><?php echo ($tbl_user->PB_ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_user_add->RightColumnClass ?>"><div<?php echo $tbl_user->PB_ID->cellAttributes() ?>>
<span id="el_tbl_user_PB_ID">
<input type="text" data-table="tbl_user" data-field="x_PB_ID" name="x_PB_ID" id="x_PB_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_user->PB_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_user->PB_ID->EditValue ?>"<?php echo $tbl_user->PB_ID->editAttributes() ?>>
</span>
<?php echo $tbl_user->PB_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_user->TD_ID->Visible) { // TD_ID ?>
	<div id="r_TD_ID" class="form-group row">
		<label id="elh_tbl_user_TD_ID" for="x_TD_ID" class="<?php echo $tbl_user_add->LeftColumnClass ?>"><?php echo $tbl_user->TD_ID->caption() ?><?php echo ($tbl_user->TD_ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_user_add->RightColumnClass ?>"><div<?php echo $tbl_user->TD_ID->cellAttributes() ?>>
<span id="el_tbl_user_TD_ID">
<input type="text" data-table="tbl_user" data-field="x_TD_ID" name="x_TD_ID" id="x_TD_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_user->TD_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_user->TD_ID->EditValue ?>"<?php echo $tbl_user->TD_ID->editAttributes() ?>>
</span>
<?php echo $tbl_user->TD_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_user->CD_ID->Visible) { // CD_ID ?>
	<div id="r_CD_ID" class="form-group row">
		<label id="elh_tbl_user_CD_ID" for="x_CD_ID" class="<?php echo $tbl_user_add->LeftColumnClass ?>"><?php echo $tbl_user->CD_ID->caption() ?><?php echo ($tbl_user->CD_ID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_user_add->RightColumnClass ?>"><div<?php echo $tbl_user->CD_ID->cellAttributes() ?>>
<span id="el_tbl_user_CD_ID">
<input type="text" data-table="tbl_user" data-field="x_CD_ID" name="x_CD_ID" id="x_CD_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_user->CD_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_user->CD_ID->EditValue ?>"<?php echo $tbl_user->CD_ID->editAttributes() ?>>
</span>
<?php echo $tbl_user->CD_ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_user_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_user_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_user_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_user_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_user_add->terminate();
?>