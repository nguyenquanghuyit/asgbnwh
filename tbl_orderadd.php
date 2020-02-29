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
$tbl_order_add = new tbl_order_add();

// Run the page
$tbl_order_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_order_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_orderadd = currentForm = new ew.Form("ftbl_orderadd", "add");

// Validate form
ftbl_orderadd.validate = function() {
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
		<?php if ($tbl_order_add->OrderDate->Required) { ?>
			elm = this.getElements("x" + infix + "_OrderDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order->OrderDate->caption(), $tbl_order->OrderDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_OrderDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_order->OrderDate->errorMessage()) ?>");
		<?php if ($tbl_order_add->InvoiceNo->Required) { ?>
			elm = this.getElements("x" + infix + "_InvoiceNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order->InvoiceNo->caption(), $tbl_order->InvoiceNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_add->CusomterOrderNo->Required) { ?>
			elm = this.getElements("x" + infix + "_CusomterOrderNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order->CusomterOrderNo->caption(), $tbl_order->CusomterOrderNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_add->IdType->Required) { ?>
			elm = this.getElements("x" + infix + "_IdType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order->IdType->caption(), $tbl_order->IdType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_add->ID_Contact->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Contact");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order->ID_Contact->caption(), $tbl_order->ID_Contact->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_add->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order->CreateUser->caption(), $tbl_order->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_add->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order->CreateDate->caption(), $tbl_order->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_order->CreateDate->errorMessage()) ?>");

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
ftbl_orderadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderadd.lists["x_IdType"] = <?php echo $tbl_order_add->IdType->Lookup->toClientList() ?>;
ftbl_orderadd.lists["x_IdType"].options = <?php echo JsonEncode($tbl_order_add->IdType->lookupOptions()) ?>;
ftbl_orderadd.lists["x_ID_Contact"] = <?php echo $tbl_order_add->ID_Contact->Lookup->toClientList() ?>;
ftbl_orderadd.lists["x_ID_Contact"].options = <?php echo JsonEncode($tbl_order_add->ID_Contact->lookupOptions()) ?>;
ftbl_orderadd.autoSuggests["x_ID_Contact"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_order_add->showPageHeader(); ?>
<?php
$tbl_order_add->showMessage();
?>
<form name="ftbl_orderadd" id="ftbl_orderadd" class="<?php echo $tbl_order_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_order_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_order_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_order">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_order_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_order->OrderDate->Visible) { // OrderDate ?>
	<div id="r_OrderDate" class="form-group row">
		<label id="elh_tbl_order_OrderDate" for="x_OrderDate" class="<?php echo $tbl_order_add->LeftColumnClass ?>"><?php echo $tbl_order->OrderDate->caption() ?><?php echo ($tbl_order->OrderDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_add->RightColumnClass ?>"><div<?php echo $tbl_order->OrderDate->cellAttributes() ?>>
<span id="el_tbl_order_OrderDate">
<input type="text" data-table="tbl_order" data-field="x_OrderDate" data-format="7" name="x_OrderDate" id="x_OrderDate" placeholder="<?php echo HtmlEncode($tbl_order->OrderDate->getPlaceHolder()) ?>" value="<?php echo $tbl_order->OrderDate->EditValue ?>"<?php echo $tbl_order->OrderDate->editAttributes() ?>>
<?php if (!$tbl_order->OrderDate->ReadOnly && !$tbl_order->OrderDate->Disabled && !isset($tbl_order->OrderDate->EditAttrs["readonly"]) && !isset($tbl_order->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_orderadd", "x_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $tbl_order->OrderDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order->InvoiceNo->Visible) { // InvoiceNo ?>
	<div id="r_InvoiceNo" class="form-group row">
		<label id="elh_tbl_order_InvoiceNo" for="x_InvoiceNo" class="<?php echo $tbl_order_add->LeftColumnClass ?>"><?php echo $tbl_order->InvoiceNo->caption() ?><?php echo ($tbl_order->InvoiceNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_add->RightColumnClass ?>"><div<?php echo $tbl_order->InvoiceNo->cellAttributes() ?>>
<span id="el_tbl_order_InvoiceNo">
<input type="text" data-table="tbl_order" data-field="x_InvoiceNo" name="x_InvoiceNo" id="x_InvoiceNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order->InvoiceNo->getPlaceHolder()) ?>" value="<?php echo $tbl_order->InvoiceNo->EditValue ?>"<?php echo $tbl_order->InvoiceNo->editAttributes() ?>>
</span>
<?php echo $tbl_order->InvoiceNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
	<div id="r_CusomterOrderNo" class="form-group row">
		<label id="elh_tbl_order_CusomterOrderNo" for="x_CusomterOrderNo" class="<?php echo $tbl_order_add->LeftColumnClass ?>"><?php echo $tbl_order->CusomterOrderNo->caption() ?><?php echo ($tbl_order->CusomterOrderNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_add->RightColumnClass ?>"><div<?php echo $tbl_order->CusomterOrderNo->cellAttributes() ?>>
<span id="el_tbl_order_CusomterOrderNo">
<input type="text" data-table="tbl_order" data-field="x_CusomterOrderNo" name="x_CusomterOrderNo" id="x_CusomterOrderNo" size="20" maxlength="15" placeholder="<?php echo HtmlEncode($tbl_order->CusomterOrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_order->CusomterOrderNo->EditValue ?>"<?php echo $tbl_order->CusomterOrderNo->editAttributes() ?>>
</span>
<?php echo $tbl_order->CusomterOrderNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order->IdType->Visible) { // IdType ?>
	<div id="r_IdType" class="form-group row">
		<label id="elh_tbl_order_IdType" for="x_IdType" class="<?php echo $tbl_order_add->LeftColumnClass ?>"><?php echo $tbl_order->IdType->caption() ?><?php echo ($tbl_order->IdType->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_add->RightColumnClass ?>"><div<?php echo $tbl_order->IdType->cellAttributes() ?>>
<span id="el_tbl_order_IdType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_order" data-field="x_IdType" data-value-separator="<?php echo $tbl_order->IdType->displayValueSeparatorAttribute() ?>" id="x_IdType" name="x_IdType"<?php echo $tbl_order->IdType->editAttributes() ?>>
		<?php echo $tbl_order->IdType->selectOptionListHtml("x_IdType") ?>
	</select>
</div>
<?php echo $tbl_order->IdType->Lookup->getParamTag("p_x_IdType") ?>
</span>
<?php echo $tbl_order->IdType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order->ID_Contact->Visible) { // ID_Contact ?>
	<div id="r_ID_Contact" class="form-group row">
		<label id="elh_tbl_order_ID_Contact" class="<?php echo $tbl_order_add->LeftColumnClass ?>"><?php echo $tbl_order->ID_Contact->caption() ?><?php echo ($tbl_order->ID_Contact->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_add->RightColumnClass ?>"><div<?php echo $tbl_order->ID_Contact->cellAttributes() ?>>
<span id="el_tbl_order_ID_Contact">
<?php
$wrkonchange = "" . trim(@$tbl_order->ID_Contact->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_order->ID_Contact->EditAttrs["onchange"] = "";
?>
<span id="as_x_ID_Contact" class="text-nowrap" style="z-index: 8940">
	<input type="text" class="form-control" name="sv_x_ID_Contact" id="sv_x_ID_Contact" value="<?php echo RemoveHtml($tbl_order->ID_Contact->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_order->ID_Contact->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_order->ID_Contact->getPlaceHolder()) ?>"<?php echo $tbl_order->ID_Contact->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order" data-field="x_ID_Contact" data-value-separator="<?php echo $tbl_order->ID_Contact->displayValueSeparatorAttribute() ?>" name="x_ID_Contact" id="x_ID_Contact" value="<?php echo HtmlEncode($tbl_order->ID_Contact->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_orderadd.createAutoSuggest({"id":"x_ID_Contact","forceSelect":true});
</script>
<?php echo $tbl_order->ID_Contact->Lookup->getParamTag("p_x_ID_Contact") ?>
</span>
<?php echo $tbl_order->ID_Contact->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order->CreateUser->Visible) { // CreateUser ?>
	<div id="r_CreateUser" class="form-group row">
		<label id="elh_tbl_order_CreateUser" for="x_CreateUser" class="<?php echo $tbl_order_add->LeftColumnClass ?>"><?php echo $tbl_order->CreateUser->caption() ?><?php echo ($tbl_order->CreateUser->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_add->RightColumnClass ?>"><div<?php echo $tbl_order->CreateUser->cellAttributes() ?>>
<span id="el_tbl_order_CreateUser">
<input type="text" data-table="tbl_order" data-field="x_CreateUser" name="x_CreateUser" id="x_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_order->CreateUser->EditValue ?>"<?php echo $tbl_order->CreateUser->editAttributes() ?>>
</span>
<?php echo $tbl_order->CreateUser->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order->CreateDate->Visible) { // CreateDate ?>
	<div id="r_CreateDate" class="form-group row">
		<label id="elh_tbl_order_CreateDate" for="x_CreateDate" class="<?php echo $tbl_order_add->LeftColumnClass ?>"><?php echo $tbl_order->CreateDate->caption() ?><?php echo ($tbl_order->CreateDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_add->RightColumnClass ?>"><div<?php echo $tbl_order->CreateDate->cellAttributes() ?>>
<span id="el_tbl_order_CreateDate">
<input type="text" data-table="tbl_order" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($tbl_order->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_order->CreateDate->EditValue ?>"<?php echo $tbl_order->CreateDate->editAttributes() ?>>
<?php if (!$tbl_order->CreateDate->ReadOnly && !$tbl_order->CreateDate->Disabled && !isset($tbl_order->CreateDate->EditAttrs["readonly"]) && !isset($tbl_order->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_orderadd", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php echo $tbl_order->CreateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($tbl_order->getCurrentDetailTable() <> "") { ?>
<?php
	$tbl_order_add->DetailPages->ValidKeys = explode(",", $tbl_order->getCurrentDetailTable());
	$firstActiveDetailTable = $tbl_order_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="tbl_order_add_details"><!-- tabs -->
	<ul class="<?php echo $tbl_order_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("tbl_orderguide", explode(",", $tbl_order->getCurrentDetailTable())) && $tbl_orderguide->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tbl_orderguide") {
			$firstActiveDetailTable = "tbl_orderguide";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $tbl_order_add->DetailPages->pageStyle("tbl_orderguide") ?>" href="#tab_tbl_orderguide" data-toggle="tab"><?php echo $Language->TablePhrase("tbl_orderguide", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("tbl_orderdetail", explode(",", $tbl_order->getCurrentDetailTable())) && $tbl_orderdetail->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tbl_orderdetail") {
			$firstActiveDetailTable = "tbl_orderdetail";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $tbl_order_add->DetailPages->pageStyle("tbl_orderdetail") ?>" href="#tab_tbl_orderdetail" data-toggle="tab"><?php echo $Language->TablePhrase("tbl_orderdetail", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("vwhistoryPicking", explode(",", $tbl_order->getCurrentDetailTable())) && $vwhistoryPicking->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "vwhistoryPicking") {
			$firstActiveDetailTable = "vwhistoryPicking";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $tbl_order_add->DetailPages->pageStyle("vwhistoryPicking") ?>" href="#tab_vwhistoryPicking" data-toggle="tab"><?php echo $Language->TablePhrase("vwhistoryPicking", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("vwPackingdetail", explode(",", $tbl_order->getCurrentDetailTable())) && $vwPackingdetail->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "vwPackingdetail") {
			$firstActiveDetailTable = "vwPackingdetail";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $tbl_order_add->DetailPages->pageStyle("vwPackingdetail") ?>" href="#tab_vwPackingdetail" data-toggle="tab"><?php echo $Language->TablePhrase("vwPackingdetail", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("tbl_orderguide", explode(",", $tbl_order->getCurrentDetailTable())) && $tbl_orderguide->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tbl_orderguide")
			$firstActiveDetailTable = "tbl_orderguide";
?>
		<div class="tab-pane<?php echo $tbl_order_add->DetailPages->pageStyle("tbl_orderguide") ?>" id="tab_tbl_orderguide"><!-- page* -->
<?php include_once "tbl_orderguidegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("tbl_orderdetail", explode(",", $tbl_order->getCurrentDetailTable())) && $tbl_orderdetail->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tbl_orderdetail")
			$firstActiveDetailTable = "tbl_orderdetail";
?>
		<div class="tab-pane<?php echo $tbl_order_add->DetailPages->pageStyle("tbl_orderdetail") ?>" id="tab_tbl_orderdetail"><!-- page* -->
<?php include_once "tbl_orderdetailgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("vwhistoryPicking", explode(",", $tbl_order->getCurrentDetailTable())) && $vwhistoryPicking->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "vwhistoryPicking")
			$firstActiveDetailTable = "vwhistoryPicking";
?>
		<div class="tab-pane<?php echo $tbl_order_add->DetailPages->pageStyle("vwhistoryPicking") ?>" id="tab_vwhistoryPicking"><!-- page* -->
<?php include_once "vwhistoryPickinggrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("vwPackingdetail", explode(",", $tbl_order->getCurrentDetailTable())) && $vwPackingdetail->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "vwPackingdetail")
			$firstActiveDetailTable = "vwPackingdetail";
?>
		<div class="tab-pane<?php echo $tbl_order_add->DetailPages->pageStyle("vwPackingdetail") ?>" id="tab_vwPackingdetail"><!-- page* -->
<?php include_once "vwPackingdetailgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$tbl_order_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_order_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_order_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_order_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_order_add->terminate();
?>