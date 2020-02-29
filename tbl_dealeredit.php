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
$tbl_dealer_edit = new tbl_dealer_edit();

// Run the page
$tbl_dealer_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_dealer_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftbl_dealeredit = currentForm = new ew.Form("ftbl_dealeredit", "edit");

// Validate form
ftbl_dealeredit.validate = function() {
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
		<?php if ($tbl_dealer_edit->DealerName->Required) { ?>
			elm = this.getElements("x" + infix + "_DealerName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_dealer->DealerName->caption(), $tbl_dealer->DealerName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_dealer_edit->Address->Required) { ?>
			elm = this.getElements("x" + infix + "_Address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_dealer->Address->caption(), $tbl_dealer->Address->RequiredErrorMessage)) ?>");
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
ftbl_dealeredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_dealeredit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_dealer_edit->showPageHeader(); ?>
<?php
$tbl_dealer_edit->showMessage();
?>
<form name="ftbl_dealeredit" id="ftbl_dealeredit" class="<?php echo $tbl_dealer_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_dealer_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_dealer_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_dealer">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_dealer_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_dealer->DealerName->Visible) { // DealerName ?>
	<div id="r_DealerName" class="form-group row">
		<label id="elh_tbl_dealer_DealerName" for="x_DealerName" class="<?php echo $tbl_dealer_edit->LeftColumnClass ?>"><?php echo $tbl_dealer->DealerName->caption() ?><?php echo ($tbl_dealer->DealerName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_dealer_edit->RightColumnClass ?>"><div<?php echo $tbl_dealer->DealerName->cellAttributes() ?>>
<span id="el_tbl_dealer_DealerName">
<input type="text" data-table="tbl_dealer" data-field="x_DealerName" name="x_DealerName" id="x_DealerName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_dealer->DealerName->getPlaceHolder()) ?>" value="<?php echo $tbl_dealer->DealerName->EditValue ?>"<?php echo $tbl_dealer->DealerName->editAttributes() ?>>
</span>
<?php echo $tbl_dealer->DealerName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_dealer->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_tbl_dealer_Address" for="x_Address" class="<?php echo $tbl_dealer_edit->LeftColumnClass ?>"><?php echo $tbl_dealer->Address->caption() ?><?php echo ($tbl_dealer->Address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_dealer_edit->RightColumnClass ?>"><div<?php echo $tbl_dealer->Address->cellAttributes() ?>>
<span id="el_tbl_dealer_Address">
<input type="text" data-table="tbl_dealer" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_dealer->Address->getPlaceHolder()) ?>" value="<?php echo $tbl_dealer->Address->EditValue ?>"<?php echo $tbl_dealer->Address->editAttributes() ?>>
</span>
<?php echo $tbl_dealer->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="tbl_dealer" data-field="x_ID_Dealer" name="x_ID_Dealer" id="x_ID_Dealer" value="<?php echo HtmlEncode($tbl_dealer->ID_Dealer->CurrentValue) ?>">
<?php if (!$tbl_dealer_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_dealer_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_dealer_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_dealer_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_dealer_edit->terminate();
?>