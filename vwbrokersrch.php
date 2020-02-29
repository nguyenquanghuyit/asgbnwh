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
$vwbroker_search = new vwbroker_search();

// Run the page
$vwbroker_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwbroker_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($vwbroker_search->IsModal) { ?>
var fvwbrokersearch = currentAdvancedSearchForm = new ew.Form("fvwbrokersearch", "search");
<?php } else { ?>
var fvwbrokersearch = currentForm = new ew.Form("fvwbrokersearch", "search");
<?php } ?>

// Form_CustomValidate event
fvwbrokersearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwbrokersearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwbrokersearch.lists["x_TypeName"] = <?php echo $vwbroker_search->TypeName->Lookup->toClientList() ?>;
fvwbrokersearch.lists["x_TypeName"].options = <?php echo JsonEncode($vwbroker_search->TypeName->lookupOptions()) ?>;

// Form object for search
// Validate function for search

fvwbrokersearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_OrderID");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwbroker->OrderID->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_ID_Order");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwbroker->ID_Order->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_PCS");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwbroker->PCS->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_CreateDate");
	if (elm && !ew.checkEuroDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwbroker->CreateDate->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_OrderDate");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwbroker->OrderDate->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $vwbroker_search->showPageHeader(); ?>
<?php
$vwbroker_search->showMessage();
?>
<form name="fvwbrokersearch" id="fvwbrokersearch" class="<?php echo $vwbroker_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwbroker_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwbroker_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwbroker">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$vwbroker_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($vwbroker->OrderID->Visible) { // OrderID ?>
	<div id="r_OrderID" class="form-group row">
		<label for="x_OrderID" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_OrderID"><?php echo $vwbroker->OrderID->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_OrderID" id="z_OrderID" value="="></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->OrderID->cellAttributes() ?>>
			<span id="el_vwbroker_OrderID">
<input type="text" data-table="vwbroker" data-field="x_OrderID" name="x_OrderID" id="x_OrderID" placeholder="<?php echo HtmlEncode($vwbroker->OrderID->getPlaceHolder()) ?>" value="<?php echo $vwbroker->OrderID->EditValue ?>"<?php echo $vwbroker->OrderID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->ID_Order->Visible) { // ID_Order ?>
	<div id="r_ID_Order" class="form-group row">
		<label for="x_ID_Order" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_ID_Order"><?php echo $vwbroker->ID_Order->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_ID_Order" id="z_ID_Order" value="="></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->ID_Order->cellAttributes() ?>>
			<span id="el_vwbroker_ID_Order">
<input type="text" data-table="vwbroker" data-field="x_ID_Order" name="x_ID_Order" id="x_ID_Order" placeholder="<?php echo HtmlEncode($vwbroker->ID_Order->getPlaceHolder()) ?>" value="<?php echo $vwbroker->ID_Order->EditValue ?>"<?php echo $vwbroker->ID_Order->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->CodeContact->Visible) { // CodeContact ?>
	<div id="r_CodeContact" class="form-group row">
		<label for="x_CodeContact" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_CodeContact"><?php echo $vwbroker->CodeContact->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_CodeContact" id="z_CodeContact" value="LIKE"></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->CodeContact->cellAttributes() ?>>
			<span id="el_vwbroker_CodeContact">
<input type="text" data-table="vwbroker" data-field="x_CodeContact" name="x_CodeContact" id="x_CodeContact" size="10" maxlength="15" placeholder="<?php echo HtmlEncode($vwbroker->CodeContact->getPlaceHolder()) ?>" value="<?php echo $vwbroker->CodeContact->EditValue ?>"<?php echo $vwbroker->CodeContact->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->CompanyName->Visible) { // CompanyName ?>
	<div id="r_CompanyName" class="form-group row">
		<label for="x_CompanyName" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_CompanyName"><?php echo $vwbroker->CompanyName->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_CompanyName" id="z_CompanyName" value="LIKE"></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->CompanyName->cellAttributes() ?>>
			<span id="el_vwbroker_CompanyName">
<input type="text" data-table="vwbroker" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwbroker->CompanyName->getPlaceHolder()) ?>" value="<?php echo $vwbroker->CompanyName->EditValue ?>"<?php echo $vwbroker->CompanyName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label for="x_Address" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_Address"><?php echo $vwbroker->Address->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_Address" id="z_Address" value="LIKE"></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->Address->cellAttributes() ?>>
			<span id="el_vwbroker_Address">
<input type="text" data-table="vwbroker" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwbroker->Address->getPlaceHolder()) ?>" value="<?php echo $vwbroker->Address->EditValue ?>"<?php echo $vwbroker->Address->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->TypeName->Visible) { // TypeName ?>
	<div id="r_TypeName" class="form-group row">
		<label for="x_TypeName" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_TypeName"><?php echo $vwbroker->TypeName->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->TypeName->cellAttributes() ?>>
			<span id="el_vwbroker_TypeName">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vwbroker" data-field="x_TypeName" data-value-separator="<?php echo $vwbroker->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $vwbroker->TypeName->editAttributes() ?>>
		<?php echo $vwbroker->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $vwbroker->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label for="x_Code" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_Code"><?php echo $vwbroker->Code->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_Code" id="z_Code" value="LIKE"></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->Code->cellAttributes() ?>>
			<span id="el_vwbroker_Code">
<input type="text" data-table="vwbroker" data-field="x_Code" name="x_Code" id="x_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwbroker->Code->getPlaceHolder()) ?>" value="<?php echo $vwbroker->Code->EditValue ?>"<?php echo $vwbroker->Code->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->ProductName->Visible) { // ProductName ?>
	<div id="r_ProductName" class="form-group row">
		<label for="x_ProductName" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_ProductName"><?php echo $vwbroker->ProductName->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_ProductName" id="z_ProductName" value="LIKE"></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->ProductName->cellAttributes() ?>>
			<span id="el_vwbroker_ProductName">
<input type="text" data-table="vwbroker" data-field="x_ProductName" name="x_ProductName" id="x_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwbroker->ProductName->getPlaceHolder()) ?>" value="<?php echo $vwbroker->ProductName->EditValue ?>"<?php echo $vwbroker->ProductName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->Model->Visible) { // Model ?>
	<div id="r_Model" class="form-group row">
		<label for="x_Model" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_Model"><?php echo $vwbroker->Model->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_Model" id="z_Model" value="LIKE"></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->Model->cellAttributes() ?>>
			<span id="el_vwbroker_Model">
<input type="text" data-table="vwbroker" data-field="x_Model" name="x_Model" id="x_Model" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwbroker->Model->getPlaceHolder()) ?>" value="<?php echo $vwbroker->Model->EditValue ?>"<?php echo $vwbroker->Model->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->PCS->Visible) { // PCS ?>
	<div id="r_PCS" class="form-group row">
		<label for="x_PCS" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_PCS"><?php echo $vwbroker->PCS->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_PCS" id="z_PCS" value="="></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->PCS->cellAttributes() ?>>
			<span id="el_vwbroker_PCS">
<input type="text" data-table="vwbroker" data-field="x_PCS" name="x_PCS" id="x_PCS" size="30" placeholder="<?php echo HtmlEncode($vwbroker->PCS->getPlaceHolder()) ?>" value="<?php echo $vwbroker->PCS->EditValue ?>"<?php echo $vwbroker->PCS->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->CreateDate->Visible) { // CreateDate ?>
	<div id="r_CreateDate" class="form-group row">
		<label for="x_CreateDate" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_CreateDate"><?php echo $vwbroker->CreateDate->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_CreateDate" id="z_CreateDate" value="BETWEEN"></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->CreateDate->cellAttributes() ?>>
			<span id="el_vwbroker_CreateDate">
<input type="text" data-table="vwbroker" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($vwbroker->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwbroker->CreateDate->EditValue ?>"<?php echo $vwbroker->CreateDate->editAttributes() ?>>
<?php if (!$vwbroker->CreateDate->ReadOnly && !$vwbroker->CreateDate->Disabled && !isset($vwbroker->CreateDate->EditAttrs["readonly"]) && !isset($vwbroker->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwbrokersearch", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
			<span class="ew-search-cond btw1_CreateDate"><label><?php echo $Language->Phrase("AND") ?></label></span>
			<span id="e2_vwbroker_CreateDate" class="btw1_CreateDate">
<input type="text" data-table="vwbroker" data-field="x_CreateDate" data-format="11" name="y_CreateDate" id="y_CreateDate" placeholder="<?php echo HtmlEncode($vwbroker->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwbroker->CreateDate->EditValue2 ?>"<?php echo $vwbroker->CreateDate->editAttributes() ?>>
<?php if (!$vwbroker->CreateDate->ReadOnly && !$vwbroker->CreateDate->Disabled && !isset($vwbroker->CreateDate->EditAttrs["readonly"]) && !isset($vwbroker->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwbrokersearch", "y_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($vwbroker->OrderDate->Visible) { // OrderDate ?>
	<div id="r_OrderDate" class="form-group row">
		<label for="x_OrderDate" class="<?php echo $vwbroker_search->LeftColumnClass ?>"><span id="elh_vwbroker_OrderDate"><?php echo $vwbroker->OrderDate->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_OrderDate" id="z_OrderDate" value="BETWEEN"></span>
		</label>
		<div class="<?php echo $vwbroker_search->RightColumnClass ?>"><div<?php echo $vwbroker->OrderDate->cellAttributes() ?>>
			<span id="el_vwbroker_OrderDate">
<input type="text" data-table="vwbroker" data-field="x_OrderDate" data-format="1" name="x_OrderDate" id="x_OrderDate" placeholder="<?php echo HtmlEncode($vwbroker->OrderDate->getPlaceHolder()) ?>" value="<?php echo $vwbroker->OrderDate->EditValue ?>"<?php echo $vwbroker->OrderDate->editAttributes() ?>>
<?php if (!$vwbroker->OrderDate->ReadOnly && !$vwbroker->OrderDate->Disabled && !isset($vwbroker->OrderDate->EditAttrs["readonly"]) && !isset($vwbroker->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwbrokersearch", "x_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":1});
</script>
<?php } ?>
</span>
			<span class="ew-search-cond btw1_OrderDate"><label><?php echo $Language->Phrase("AND") ?></label></span>
			<span id="e2_vwbroker_OrderDate" class="btw1_OrderDate">
<input type="text" data-table="vwbroker" data-field="x_OrderDate" data-format="1" name="y_OrderDate" id="y_OrderDate" placeholder="<?php echo HtmlEncode($vwbroker->OrderDate->getPlaceHolder()) ?>" value="<?php echo $vwbroker->OrderDate->EditValue2 ?>"<?php echo $vwbroker->OrderDate->editAttributes() ?>>
<?php if (!$vwbroker->OrderDate->ReadOnly && !$vwbroker->OrderDate->Disabled && !isset($vwbroker->OrderDate->EditAttrs["readonly"]) && !isset($vwbroker->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwbrokersearch", "y_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":1});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$vwbroker_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $vwbroker_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$vwbroker_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$vwbroker_search->terminate();
?>