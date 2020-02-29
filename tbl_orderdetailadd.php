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
$tbl_orderdetail_add = new tbl_orderdetail_add();

// Run the page
$tbl_orderdetail_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_orderdetail_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_orderdetailadd = currentForm = new ew.Form("ftbl_orderdetailadd", "add");

// Validate form
ftbl_orderdetailadd.validate = function() {
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
		<?php if ($tbl_orderdetail_add->OrderNo->Required) { ?>
			elm = this.getElements("x" + infix + "_OrderNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderdetail->OrderNo->caption(), $tbl_orderdetail->OrderNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_orderdetail_add->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderdetail->Code->caption(), $tbl_orderdetail->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_orderdetail_add->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderdetail->PCS->caption(), $tbl_orderdetail->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_orderdetail->PCS->errorMessage()) ?>");

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
ftbl_orderdetailadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderdetailadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_orderdetail_add->showPageHeader(); ?>
<?php
$tbl_orderdetail_add->showMessage();
?>
<form name="ftbl_orderdetailadd" id="ftbl_orderdetailadd" class="<?php echo $tbl_orderdetail_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_orderdetail_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_orderdetail_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_orderdetail">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_orderdetail_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_orderdetail->OrderNo->Visible) { // OrderNo ?>
	<div id="r_OrderNo" class="form-group row">
		<label id="elh_tbl_orderdetail_OrderNo" for="x_OrderNo" class="<?php echo $tbl_orderdetail_add->LeftColumnClass ?>"><?php echo $tbl_orderdetail->OrderNo->caption() ?><?php echo ($tbl_orderdetail->OrderNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_orderdetail_add->RightColumnClass ?>"><div<?php echo $tbl_orderdetail->OrderNo->cellAttributes() ?>>
<span id="el_tbl_orderdetail_OrderNo">
<input type="text" data-table="tbl_orderdetail" data-field="x_OrderNo" name="x_OrderNo" id="x_OrderNo" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($tbl_orderdetail->OrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_orderdetail->OrderNo->EditValue ?>"<?php echo $tbl_orderdetail->OrderNo->editAttributes() ?>>
</span>
<?php echo $tbl_orderdetail->OrderNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_orderdetail->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label id="elh_tbl_orderdetail_Code" for="x_Code" class="<?php echo $tbl_orderdetail_add->LeftColumnClass ?>"><?php echo $tbl_orderdetail->Code->caption() ?><?php echo ($tbl_orderdetail->Code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_orderdetail_add->RightColumnClass ?>"><div<?php echo $tbl_orderdetail->Code->cellAttributes() ?>>
<span id="el_tbl_orderdetail_Code">
<input type="text" data-table="tbl_orderdetail" data-field="x_Code" name="x_Code" id="x_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_orderdetail->Code->EditValue ?>"<?php echo $tbl_orderdetail->Code->editAttributes() ?>>
</span>
<?php echo $tbl_orderdetail->Code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_orderdetail->PCS->Visible) { // PCS ?>
	<div id="r_PCS" class="form-group row">
		<label id="elh_tbl_orderdetail_PCS" for="x_PCS" class="<?php echo $tbl_orderdetail_add->LeftColumnClass ?>"><?php echo $tbl_orderdetail->PCS->caption() ?><?php echo ($tbl_orderdetail->PCS->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_orderdetail_add->RightColumnClass ?>"><div<?php echo $tbl_orderdetail->PCS->cellAttributes() ?>>
<span id="el_tbl_orderdetail_PCS">
<input type="text" data-table="tbl_orderdetail" data-field="x_PCS" name="x_PCS" id="x_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_orderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_orderdetail->PCS->EditValue ?>"<?php echo $tbl_orderdetail->PCS->editAttributes() ?>>
</span>
<?php echo $tbl_orderdetail->PCS->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_orderdetail_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_orderdetail_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_orderdetail_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_orderdetail_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_orderdetail_add->terminate();
?>