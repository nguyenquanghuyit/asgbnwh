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
$tbl_packunit_add = new tbl_packunit_add();

// Run the page
$tbl_packunit_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_packunit_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_packunitadd = currentForm = new ew.Form("ftbl_packunitadd", "add");

// Validate form
ftbl_packunitadd.validate = function() {
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
		<?php if ($tbl_packunit_add->packNo->Required) { ?>
			elm = this.getElements("x" + infix + "_packNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packunit->packNo->caption(), $tbl_packunit->packNo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_packNo");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_packunit->packNo->errorMessage()) ?>");
		<?php if ($tbl_packunit_add->idUnit->Required) { ?>
			elm = this.getElements("x" + infix + "_idUnit");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packunit->idUnit->caption(), $tbl_packunit->idUnit->RequiredErrorMessage)) ?>");
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
ftbl_packunitadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_packunitadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_packunitadd.lists["x_idUnit"] = <?php echo $tbl_packunit_add->idUnit->Lookup->toClientList() ?>;
ftbl_packunitadd.lists["x_idUnit"].options = <?php echo JsonEncode($tbl_packunit_add->idUnit->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_packunit_add->showPageHeader(); ?>
<?php
$tbl_packunit_add->showMessage();
?>
<form name="ftbl_packunitadd" id="ftbl_packunitadd" class="<?php echo $tbl_packunit_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_packunit_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_packunit_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_packunit">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_packunit_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_packunit->packNo->Visible) { // packNo ?>
	<div id="r_packNo" class="form-group row">
		<label id="elh_tbl_packunit_packNo" for="x_packNo" class="<?php echo $tbl_packunit_add->LeftColumnClass ?>"><?php echo $tbl_packunit->packNo->caption() ?><?php echo ($tbl_packunit->packNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_packunit_add->RightColumnClass ?>"><div<?php echo $tbl_packunit->packNo->cellAttributes() ?>>
<span id="el_tbl_packunit_packNo">
<input type="text" data-table="tbl_packunit" data-field="x_packNo" name="x_packNo" id="x_packNo" size="30" placeholder="<?php echo HtmlEncode($tbl_packunit->packNo->getPlaceHolder()) ?>" value="<?php echo $tbl_packunit->packNo->EditValue ?>"<?php echo $tbl_packunit->packNo->editAttributes() ?>>
</span>
<?php echo $tbl_packunit->packNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_packunit->idUnit->Visible) { // idUnit ?>
	<div id="r_idUnit" class="form-group row">
		<label id="elh_tbl_packunit_idUnit" for="x_idUnit" class="<?php echo $tbl_packunit_add->LeftColumnClass ?>"><?php echo $tbl_packunit->idUnit->caption() ?><?php echo ($tbl_packunit->idUnit->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_packunit_add->RightColumnClass ?>"><div<?php echo $tbl_packunit->idUnit->cellAttributes() ?>>
<span id="el_tbl_packunit_idUnit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_packunit" data-field="x_idUnit" data-value-separator="<?php echo $tbl_packunit->idUnit->displayValueSeparatorAttribute() ?>" id="x_idUnit" name="x_idUnit"<?php echo $tbl_packunit->idUnit->editAttributes() ?>>
		<?php echo $tbl_packunit->idUnit->selectOptionListHtml("x_idUnit") ?>
	</select>
<?php if (AllowAdd(CurrentProjectID() . "tbl_unit") && !$tbl_packunit->idUnit->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_idUnit" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $tbl_packunit->idUnit->caption() ?>" data-title="<?php echo $tbl_packunit->idUnit->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_idUnit',url:'tbl_unitaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
</div>
<?php echo $tbl_packunit->idUnit->Lookup->getParamTag("p_x_idUnit") ?>
</span>
<?php echo $tbl_packunit->idUnit->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_packunit_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_packunit_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_packunit_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_packunit_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_packunit_add->terminate();
?>