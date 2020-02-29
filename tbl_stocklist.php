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
$tbl_stock_list = new tbl_stock_list();

// Run the page
$tbl_stock_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_stock_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_stock->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_stocklist = currentForm = new ew.Form("ftbl_stocklist", "list");
ftbl_stocklist.formKeyCountName = '<?php echo $tbl_stock_list->FormKeyCountName ?>';

// Validate form
ftbl_stocklist.validate = function() {
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
		<?php if ($tbl_stock_list->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->PalletID->caption(), $tbl_stock->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_list->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->Code->caption(), $tbl_stock->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_list->IdType->Required) { ?>
			elm = this.getElements("x" + infix + "_IdType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->IdType->caption(), $tbl_stock->IdType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_list->ID_Location->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->ID_Location->caption(), $tbl_stock->ID_Location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_list->Pcs_RemainPicking->Required) { ?>
			elm = this.getElements("x" + infix + "_Pcs_RemainPicking");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->Pcs_RemainPicking->caption(), $tbl_stock->Pcs_RemainPicking->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Pcs_RemainPicking");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_stock->Pcs_RemainPicking->errorMessage()) ?>");
		<?php if ($tbl_stock_list->MFG->Required) { ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->MFG->caption(), $tbl_stock->MFG->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_list->Note_PalletId->Required) { ?>
			elm = this.getElements("x" + infix + "_Note_PalletId");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->Note_PalletId->caption(), $tbl_stock->Note_PalletId->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_list->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->CreateUser->caption(), $tbl_stock->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_list->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->CreateDate->caption(), $tbl_stock->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_stocklist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_stocklist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_stocklist.lists["x_IdType"] = <?php echo $tbl_stock_list->IdType->Lookup->toClientList() ?>;
ftbl_stocklist.lists["x_IdType"].options = <?php echo JsonEncode($tbl_stock_list->IdType->lookupOptions()) ?>;
ftbl_stocklist.lists["x_ID_Location"] = <?php echo $tbl_stock_list->ID_Location->Lookup->toClientList() ?>;
ftbl_stocklist.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_stock_list->ID_Location->lookupOptions()) ?>;
ftbl_stocklist.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var ftbl_stocklistsrch = currentSearchForm = new ew.Form("ftbl_stocklistsrch");

// Validate function for search
ftbl_stocklistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_MFG");
	if (elm && !ew.checkEuroDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($tbl_stock->MFG->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_CreateDate");
	if (elm && !ew.checkEuroDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($tbl_stock->CreateDate->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ftbl_stocklistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_stocklistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_stocklistsrch.lists["x_IdType"] = <?php echo $tbl_stock_list->IdType->Lookup->toClientList() ?>;
ftbl_stocklistsrch.lists["x_IdType"].options = <?php echo JsonEncode($tbl_stock_list->IdType->lookupOptions()) ?>;
ftbl_stocklistsrch.lists["x_ID_Location"] = <?php echo $tbl_stock_list->ID_Location->Lookup->toClientList() ?>;
ftbl_stocklistsrch.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_stock_list->ID_Location->lookupOptions()) ?>;
ftbl_stocklistsrch.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Filters
ftbl_stocklistsrch.filterList = <?php echo $tbl_stock_list->getFilterList() ?>;
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script src="phpjs/ewpreview.js"></script>
<script>
ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
ew.PREVIEW_SINGLE_ROW = false;
ew.PREVIEW_OVERLAY = false;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_stock->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_stock_list->TotalRecs > 0 && $tbl_stock_list->ExportOptions->visible()) { ?>
<?php $tbl_stock_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_stock_list->ImportOptions->visible()) { ?>
<?php $tbl_stock_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_stock_list->SearchOptions->visible()) { ?>
<?php $tbl_stock_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_stock_list->FilterOptions->visible()) { ?>
<?php $tbl_stock_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_stock_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_stock->isExport() && !$tbl_stock->CurrentAction) { ?>
<form name="ftbl_stocklistsrch" id="ftbl_stocklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_stock_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_stocklistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_stock">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$tbl_stock_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_stock->RowType = ROWTYPE_SEARCH;

// Render row
$tbl_stock->resetAttributes();
$tbl_stock_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($tbl_stock->IdType->Visible) { // IdType ?>
	<div id="xsc_IdType" class="ew-cell form-group">
		<label for="x_IdType" class="ew-search-caption ew-label"><?php echo $tbl_stock->IdType->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_IdType" id="z_IdType" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_stock" data-field="x_IdType" data-value-separator="<?php echo $tbl_stock->IdType->displayValueSeparatorAttribute() ?>" id="x_IdType" name="x_IdType"<?php echo $tbl_stock->IdType->editAttributes() ?>>
		<?php echo $tbl_stock->IdType->selectOptionListHtml("x_IdType") ?>
	</select>
</div>
<?php echo $tbl_stock->IdType->Lookup->getParamTag("p_x_IdType") ?>
</span>
	</div>
<?php } ?>

<?php if ($tbl_stock->ID_Location->Visible) { // ID_Location ?>
	<div id="xsc_ID_Location" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $tbl_stock->ID_Location->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("=") ?><input type="hidden" name="z_ID_Location" id="z_ID_Location" value="="></span>
		<span class="ew-search-field">
<?php
$wrkonchange = "" . trim(@$tbl_stock->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_stock->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x_ID_Location" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_ID_Location" id="sv_x_ID_Location" value="<?php echo RemoveHtml($tbl_stock->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_stock->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_stock->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_stock->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_stock->ID_Location->displayValueSeparatorAttribute() ?>" name="x_ID_Location" id="x_ID_Location" value="<?php echo HtmlEncode($tbl_stock->ID_Location->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_stocklistsrch.createAutoSuggest({"id":"x_ID_Location","forceSelect":false});
</script>
<?php echo $tbl_stock->ID_Location->Lookup->getParamTag("p_x_ID_Location") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
<?php if ($tbl_stock->MFG->Visible) { // MFG ?>
	<div id="xsc_MFG" class="ew-cell form-group">
		<label for="x_MFG" class="ew-search-caption ew-label"><?php echo $tbl_stock->MFG->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_MFG" id="z_MFG" value="BETWEEN"></span>
		<span class="ew-search-field">
<input type="text" data-table="tbl_stock" data-field="x_MFG" data-format="7" name="x_MFG" id="x_MFG" placeholder="<?php echo HtmlEncode($tbl_stock->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->MFG->EditValue ?>"<?php echo $tbl_stock->MFG->editAttributes() ?>>
<?php if (!$tbl_stock->MFG->ReadOnly && !$tbl_stock->MFG->Disabled && !isset($tbl_stock->MFG->EditAttrs["readonly"]) && !isset($tbl_stock->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_stocklistsrch", "x_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw1_MFG"><label><?php echo $Language->Phrase("AND") ?></label></span>
		<span class="ew-search-field btw1_MFG">
<input type="text" data-table="tbl_stock" data-field="x_MFG" data-format="7" name="y_MFG" id="y_MFG" placeholder="<?php echo HtmlEncode($tbl_stock->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->MFG->EditValue2 ?>"<?php echo $tbl_stock->MFG->editAttributes() ?>>
<?php if (!$tbl_stock->MFG->ReadOnly && !$tbl_stock->MFG->Disabled && !isset($tbl_stock->MFG->EditAttrs["readonly"]) && !isset($tbl_stock->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_stocklistsrch", "y_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ew-row d-sm-flex">
<?php if ($tbl_stock->CreateDate->Visible) { // CreateDate ?>
	<div id="xsc_CreateDate" class="ew-cell form-group">
		<label for="x_CreateDate" class="ew-search-caption ew-label"><?php echo $tbl_stock->CreateDate->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_CreateDate" id="z_CreateDate" value="BETWEEN"></span>
		<span class="ew-search-field">
<input type="text" data-table="tbl_stock" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($tbl_stock->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->CreateDate->EditValue ?>"<?php echo $tbl_stock->CreateDate->editAttributes() ?>>
<?php if (!$tbl_stock->CreateDate->ReadOnly && !$tbl_stock->CreateDate->Disabled && !isset($tbl_stock->CreateDate->EditAttrs["readonly"]) && !isset($tbl_stock->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_stocklistsrch", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw1_CreateDate"><label><?php echo $Language->Phrase("AND") ?></label></span>
		<span class="ew-search-field btw1_CreateDate">
<input type="text" data-table="tbl_stock" data-field="x_CreateDate" data-format="11" name="y_CreateDate" id="y_CreateDate" placeholder="<?php echo HtmlEncode($tbl_stock->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->CreateDate->EditValue2 ?>"<?php echo $tbl_stock->CreateDate->editAttributes() ?>>
<?php if (!$tbl_stock->CreateDate->ReadOnly && !$tbl_stock->CreateDate->Disabled && !isset($tbl_stock->CreateDate->EditAttrs["readonly"]) && !isset($tbl_stock->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_stocklistsrch", "y_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_5" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_stock_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_stock_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_stock_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_stock_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_stock_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_stock_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_stock_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_stock_list->showPageHeader(); ?>
<?php
$tbl_stock_list->showMessage();
?>
<?php if ($tbl_stock_list->TotalRecs > 0 || $tbl_stock->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_stock_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_stock">
<?php if (!$tbl_stock->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_stock->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_stock_list->Pager)) $tbl_stock_list->Pager = new PrevNextPager($tbl_stock_list->StartRec, $tbl_stock_list->DisplayRecs, $tbl_stock_list->TotalRecs, $tbl_stock_list->AutoHidePager) ?>
<?php if ($tbl_stock_list->Pager->RecordCount > 0 && $tbl_stock_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_stock_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_stock_list->pageUrl() ?>start=<?php echo $tbl_stock_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_stock_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_stock_list->pageUrl() ?>start=<?php echo $tbl_stock_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_stock_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_stock_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_stock_list->pageUrl() ?>start=<?php echo $tbl_stock_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_stock_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_stock_list->pageUrl() ?>start=<?php echo $tbl_stock_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_stock_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_stock_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_stock_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_stock_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_stock_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_stock_list->TotalRecs > 0 && (!$tbl_stock_list->AutoHidePageSizeSelector || $tbl_stock_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_stock">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_stock_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_stock_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_stock_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_stock_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_stock_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_stock->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_stock_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_stocklist" id="ftbl_stocklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_stock_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_stock_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_stock">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_stock" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_stock_list->TotalRecs > 0 || $tbl_stock->isGridEdit()) { ?>
<table id="tbl_tbl_stocklist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_stock_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_stock_list->renderListOptions();

// Render list options (header, left)
$tbl_stock_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_stock->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_stock->sortUrl($tbl_stock->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_stock->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_stock_PalletID" class="tbl_stock_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_stock->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_stock->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_stock->SortUrl($tbl_stock->PalletID) ?>',2);"><div id="elh_tbl_stock_PalletID" class="tbl_stock_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_stock->PalletID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_stock->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_stock->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_stock->Code->Visible) { // Code ?>
	<?php if ($tbl_stock->sortUrl($tbl_stock->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_stock->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_stock_Code" class="tbl_stock_Code"><div class="ew-table-header-caption"><?php echo $tbl_stock->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_stock->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_stock->SortUrl($tbl_stock->Code) ?>',2);"><div id="elh_tbl_stock_Code" class="tbl_stock_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_stock->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_stock->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_stock->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_stock->IdType->Visible) { // IdType ?>
	<?php if ($tbl_stock->sortUrl($tbl_stock->IdType) == "") { ?>
		<th data-name="IdType" class="<?php echo $tbl_stock->IdType->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_stock_IdType" class="tbl_stock_IdType"><div class="ew-table-header-caption"><?php echo $tbl_stock->IdType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IdType" class="<?php echo $tbl_stock->IdType->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_stock->SortUrl($tbl_stock->IdType) ?>',2);"><div id="elh_tbl_stock_IdType" class="tbl_stock_IdType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_stock->IdType->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_stock->IdType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_stock->IdType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_stock->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_stock->sortUrl($tbl_stock->ID_Location) == "") { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_stock->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_stock_ID_Location" class="tbl_stock_ID_Location"><div class="ew-table-header-caption"><?php echo $tbl_stock->ID_Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_stock->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_stock->SortUrl($tbl_stock->ID_Location) ?>',2);"><div id="elh_tbl_stock_ID_Location" class="tbl_stock_ID_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_stock->ID_Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_stock->ID_Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_stock->ID_Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_stock->Pcs_RemainPicking->Visible) { // Pcs_RemainPicking ?>
	<?php if ($tbl_stock->sortUrl($tbl_stock->Pcs_RemainPicking) == "") { ?>
		<th data-name="Pcs_RemainPicking" class="<?php echo $tbl_stock->Pcs_RemainPicking->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_stock_Pcs_RemainPicking" class="tbl_stock_Pcs_RemainPicking"><div class="ew-table-header-caption"><?php echo $tbl_stock->Pcs_RemainPicking->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pcs_RemainPicking" class="<?php echo $tbl_stock->Pcs_RemainPicking->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_stock->SortUrl($tbl_stock->Pcs_RemainPicking) ?>',2);"><div id="elh_tbl_stock_Pcs_RemainPicking" class="tbl_stock_Pcs_RemainPicking">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_stock->Pcs_RemainPicking->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_stock->Pcs_RemainPicking->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_stock->Pcs_RemainPicking->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_stock->MFG->Visible) { // MFG ?>
	<?php if ($tbl_stock->sortUrl($tbl_stock->MFG) == "") { ?>
		<th data-name="MFG" class="<?php echo $tbl_stock->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_stock_MFG" class="tbl_stock_MFG"><div class="ew-table-header-caption"><?php echo $tbl_stock->MFG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MFG" class="<?php echo $tbl_stock->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_stock->SortUrl($tbl_stock->MFG) ?>',2);"><div id="elh_tbl_stock_MFG" class="tbl_stock_MFG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_stock->MFG->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_stock->MFG->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_stock->MFG->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_stock->Note_PalletId->Visible) { // Note_PalletId ?>
	<?php if ($tbl_stock->sortUrl($tbl_stock->Note_PalletId) == "") { ?>
		<th data-name="Note_PalletId" class="<?php echo $tbl_stock->Note_PalletId->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_stock_Note_PalletId" class="tbl_stock_Note_PalletId"><div class="ew-table-header-caption"><?php echo $tbl_stock->Note_PalletId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Note_PalletId" class="<?php echo $tbl_stock->Note_PalletId->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_stock->SortUrl($tbl_stock->Note_PalletId) ?>',2);"><div id="elh_tbl_stock_Note_PalletId" class="tbl_stock_Note_PalletId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_stock->Note_PalletId->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_stock->Note_PalletId->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_stock->Note_PalletId->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_stock->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_stock->sortUrl($tbl_stock->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_stock->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_stock_CreateUser" class="tbl_stock_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_stock->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_stock->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_stock->SortUrl($tbl_stock->CreateUser) ?>',2);"><div id="elh_tbl_stock_CreateUser" class="tbl_stock_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_stock->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_stock->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_stock->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_stock->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_stock->sortUrl($tbl_stock->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_stock->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_stock_CreateDate" class="tbl_stock_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_stock->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_stock->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_stock->SortUrl($tbl_stock->CreateDate) ?>',2);"><div id="elh_tbl_stock_CreateDate" class="tbl_stock_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_stock->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_stock->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_stock->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_stock_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_stock->ExportAll && $tbl_stock->isExport()) {
	$tbl_stock_list->StopRec = $tbl_stock_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_stock_list->TotalRecs > $tbl_stock_list->StartRec + $tbl_stock_list->DisplayRecs - 1)
		$tbl_stock_list->StopRec = $tbl_stock_list->StartRec + $tbl_stock_list->DisplayRecs - 1;
	else
		$tbl_stock_list->StopRec = $tbl_stock_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_stock_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_stock_list->FormKeyCountName) && ($tbl_stock->isGridAdd() || $tbl_stock->isGridEdit() || $tbl_stock->isConfirm())) {
		$tbl_stock_list->KeyCount = $CurrentForm->getValue($tbl_stock_list->FormKeyCountName);
		$tbl_stock_list->StopRec = $tbl_stock_list->StartRec + $tbl_stock_list->KeyCount - 1;
	}
}
$tbl_stock_list->RecCnt = $tbl_stock_list->StartRec - 1;
if ($tbl_stock_list->Recordset && !$tbl_stock_list->Recordset->EOF) {
	$tbl_stock_list->Recordset->moveFirst();
	$selectLimit = $tbl_stock_list->UseSelectLimit;
	if (!$selectLimit && $tbl_stock_list->StartRec > 1)
		$tbl_stock_list->Recordset->move($tbl_stock_list->StartRec - 1);
} elseif (!$tbl_stock->AllowAddDeleteRow && $tbl_stock_list->StopRec == 0) {
	$tbl_stock_list->StopRec = $tbl_stock->GridAddRowCount;
}

// Initialize aggregate
$tbl_stock->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_stock->resetAttributes();
$tbl_stock_list->renderRow();
if ($tbl_stock->isGridEdit())
	$tbl_stock_list->RowIndex = 0;
while ($tbl_stock_list->RecCnt < $tbl_stock_list->StopRec) {
	$tbl_stock_list->RecCnt++;
	if ($tbl_stock_list->RecCnt >= $tbl_stock_list->StartRec) {
		$tbl_stock_list->RowCnt++;
		if ($tbl_stock->isGridAdd() || $tbl_stock->isGridEdit() || $tbl_stock->isConfirm()) {
			$tbl_stock_list->RowIndex++;
			$CurrentForm->Index = $tbl_stock_list->RowIndex;
			if ($CurrentForm->hasValue($tbl_stock_list->FormActionName) && $tbl_stock_list->EventCancelled)
				$tbl_stock_list->RowAction = strval($CurrentForm->getValue($tbl_stock_list->FormActionName));
			elseif ($tbl_stock->isGridAdd())
				$tbl_stock_list->RowAction = "insert";
			else
				$tbl_stock_list->RowAction = "";
		}

		// Set up key count
		$tbl_stock_list->KeyCount = $tbl_stock_list->RowIndex;

		// Init row class and style
		$tbl_stock->resetAttributes();
		$tbl_stock->CssClass = "";
		if ($tbl_stock->isGridAdd()) {
			$tbl_stock_list->loadRowValues(); // Load default values
		} else {
			$tbl_stock_list->loadRowValues($tbl_stock_list->Recordset); // Load row values
		}
		$tbl_stock->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_stock->isGridEdit()) { // Grid edit
			if ($tbl_stock->EventCancelled)
				$tbl_stock_list->restoreCurrentRowFormValues($tbl_stock_list->RowIndex); // Restore form values
			if ($tbl_stock_list->RowAction == "insert")
				$tbl_stock->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_stock->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_stock->isGridEdit() && ($tbl_stock->RowType == ROWTYPE_EDIT || $tbl_stock->RowType == ROWTYPE_ADD) && $tbl_stock->EventCancelled) // Update failed
			$tbl_stock_list->restoreCurrentRowFormValues($tbl_stock_list->RowIndex); // Restore form values
		if ($tbl_stock->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_stock_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_stock->RowAttrs = array_merge($tbl_stock->RowAttrs, array('data-rowindex'=>$tbl_stock_list->RowCnt, 'id'=>'r' . $tbl_stock_list->RowCnt . '_tbl_stock', 'data-rowtype'=>$tbl_stock->RowType));

		// Render row
		$tbl_stock_list->renderRow();

		// Render list options
		$tbl_stock_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_stock_list->RowAction <> "delete" && $tbl_stock_list->RowAction <> "insertdelete" && !($tbl_stock_list->RowAction == "insert" && $tbl_stock->isConfirm() && $tbl_stock_list->emptyRow())) {
?>
	<tr<?php echo $tbl_stock->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_stock_list->ListOptions->render("body", "left", $tbl_stock_list->RowCnt);
?>
	<?php if ($tbl_stock->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_stock->PalletID->cellAttributes() ?>>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_PalletID" class="form-group tbl_stock_PalletID">
<input type="text" data-table="tbl_stock" data-field="x_PalletID" name="x<?php echo $tbl_stock_list->RowIndex ?>_PalletID" id="x<?php echo $tbl_stock_list->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->PalletID->EditValue ?>"<?php echo $tbl_stock->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_PalletID" name="o<?php echo $tbl_stock_list->RowIndex ?>_PalletID" id="o<?php echo $tbl_stock_list->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_stock->PalletID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_PalletID" class="form-group tbl_stock_PalletID">
<input type="text" data-table="tbl_stock" data-field="x_PalletID" name="x<?php echo $tbl_stock_list->RowIndex ?>_PalletID" id="x<?php echo $tbl_stock_list->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->PalletID->EditValue ?>"<?php echo $tbl_stock->PalletID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_PalletID" class="tbl_stock_PalletID">
<span<?php echo $tbl_stock->PalletID->viewAttributes() ?>>
<?php echo $tbl_stock->PalletID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_stock" data-field="x_ID_Stock" name="x<?php echo $tbl_stock_list->RowIndex ?>_ID_Stock" id="x<?php echo $tbl_stock_list->RowIndex ?>_ID_Stock" value="<?php echo HtmlEncode($tbl_stock->ID_Stock->CurrentValue) ?>">
<input type="hidden" data-table="tbl_stock" data-field="x_ID_Stock" name="o<?php echo $tbl_stock_list->RowIndex ?>_ID_Stock" id="o<?php echo $tbl_stock_list->RowIndex ?>_ID_Stock" value="<?php echo HtmlEncode($tbl_stock->ID_Stock->OldValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_EDIT || $tbl_stock->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_stock" data-field="x_ID_Stock" name="x<?php echo $tbl_stock_list->RowIndex ?>_ID_Stock" id="x<?php echo $tbl_stock_list->RowIndex ?>_ID_Stock" value="<?php echo HtmlEncode($tbl_stock->ID_Stock->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_stock->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_stock->Code->cellAttributes() ?>>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_Code" class="form-group tbl_stock_Code">
<input type="text" data-table="tbl_stock" data-field="x_Code" name="x<?php echo $tbl_stock_list->RowIndex ?>_Code" id="x<?php echo $tbl_stock_list->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Code->EditValue ?>"<?php echo $tbl_stock->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_Code" name="o<?php echo $tbl_stock_list->RowIndex ?>_Code" id="o<?php echo $tbl_stock_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_stock->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_Code" class="form-group tbl_stock_Code">
<input type="text" data-table="tbl_stock" data-field="x_Code" name="x<?php echo $tbl_stock_list->RowIndex ?>_Code" id="x<?php echo $tbl_stock_list->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Code->EditValue ?>"<?php echo $tbl_stock->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_Code" class="tbl_stock_Code">
<span<?php echo $tbl_stock->Code->viewAttributes() ?>>
<?php echo $tbl_stock->Code->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_stock->IdType->Visible) { // IdType ?>
		<td data-name="IdType"<?php echo $tbl_stock->IdType->cellAttributes() ?>>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_IdType" class="form-group tbl_stock_IdType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_stock" data-field="x_IdType" data-value-separator="<?php echo $tbl_stock->IdType->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_stock_list->RowIndex ?>_IdType" name="x<?php echo $tbl_stock_list->RowIndex ?>_IdType"<?php echo $tbl_stock->IdType->editAttributes() ?>>
		<?php echo $tbl_stock->IdType->selectOptionListHtml("x<?php echo $tbl_stock_list->RowIndex ?>_IdType") ?>
	</select>
</div>
<?php echo $tbl_stock->IdType->Lookup->getParamTag("p_x" . $tbl_stock_list->RowIndex . "_IdType") ?>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_IdType" name="o<?php echo $tbl_stock_list->RowIndex ?>_IdType" id="o<?php echo $tbl_stock_list->RowIndex ?>_IdType" value="<?php echo HtmlEncode($tbl_stock->IdType->OldValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_IdType" class="form-group tbl_stock_IdType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_stock" data-field="x_IdType" data-value-separator="<?php echo $tbl_stock->IdType->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_stock_list->RowIndex ?>_IdType" name="x<?php echo $tbl_stock_list->RowIndex ?>_IdType"<?php echo $tbl_stock->IdType->editAttributes() ?>>
		<?php echo $tbl_stock->IdType->selectOptionListHtml("x<?php echo $tbl_stock_list->RowIndex ?>_IdType") ?>
	</select>
</div>
<?php echo $tbl_stock->IdType->Lookup->getParamTag("p_x" . $tbl_stock_list->RowIndex . "_IdType") ?>
</span>
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_IdType" class="tbl_stock_IdType">
<span<?php echo $tbl_stock->IdType->viewAttributes() ?>>
<?php echo $tbl_stock->IdType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_stock->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location"<?php echo $tbl_stock->ID_Location->cellAttributes() ?>>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_ID_Location" class="form-group tbl_stock_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_stock->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_stock->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_stock_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_stock->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_stock->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_stock->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_stock->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_stock->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" id="x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_stock->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_stocklist.createAutoSuggest({"id":"x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_stock->ID_Location->Lookup->getParamTag("p_x" . $tbl_stock_list->RowIndex . "_ID_Location") ?>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_ID_Location" name="o<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" id="o<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_stock->ID_Location->OldValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_ID_Location" class="form-group tbl_stock_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_stock->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_stock->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_stock_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_stock->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_stock->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_stock->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_stock->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_stock->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" id="x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_stock->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_stocklist.createAutoSuggest({"id":"x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_stock->ID_Location->Lookup->getParamTag("p_x" . $tbl_stock_list->RowIndex . "_ID_Location") ?>
</span>
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_ID_Location" class="tbl_stock_ID_Location">
<span<?php echo $tbl_stock->ID_Location->viewAttributes() ?>>
<?php echo $tbl_stock->ID_Location->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_stock->Pcs_RemainPicking->Visible) { // Pcs_RemainPicking ?>
		<td data-name="Pcs_RemainPicking"<?php echo $tbl_stock->Pcs_RemainPicking->cellAttributes() ?>>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_Pcs_RemainPicking" class="form-group tbl_stock_Pcs_RemainPicking">
<input type="text" data-table="tbl_stock" data-field="x_Pcs_RemainPicking" name="x<?php echo $tbl_stock_list->RowIndex ?>_Pcs_RemainPicking" id="x<?php echo $tbl_stock_list->RowIndex ?>_Pcs_RemainPicking" size="3" placeholder="<?php echo HtmlEncode($tbl_stock->Pcs_RemainPicking->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Pcs_RemainPicking->EditValue ?>"<?php echo $tbl_stock->Pcs_RemainPicking->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_Pcs_RemainPicking" name="o<?php echo $tbl_stock_list->RowIndex ?>_Pcs_RemainPicking" id="o<?php echo $tbl_stock_list->RowIndex ?>_Pcs_RemainPicking" value="<?php echo HtmlEncode($tbl_stock->Pcs_RemainPicking->OldValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_Pcs_RemainPicking" class="form-group tbl_stock_Pcs_RemainPicking">
<input type="text" data-table="tbl_stock" data-field="x_Pcs_RemainPicking" name="x<?php echo $tbl_stock_list->RowIndex ?>_Pcs_RemainPicking" id="x<?php echo $tbl_stock_list->RowIndex ?>_Pcs_RemainPicking" size="3" placeholder="<?php echo HtmlEncode($tbl_stock->Pcs_RemainPicking->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Pcs_RemainPicking->EditValue ?>"<?php echo $tbl_stock->Pcs_RemainPicking->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_Pcs_RemainPicking" class="tbl_stock_Pcs_RemainPicking">
<span<?php echo $tbl_stock->Pcs_RemainPicking->viewAttributes() ?>>
<?php echo $tbl_stock->Pcs_RemainPicking->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_stock->MFG->Visible) { // MFG ?>
		<td data-name="MFG"<?php echo $tbl_stock->MFG->cellAttributes() ?>>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_MFG" class="form-group tbl_stock_MFG">
<input type="text" data-table="tbl_stock" data-field="x_MFG" data-format="7" name="x<?php echo $tbl_stock_list->RowIndex ?>_MFG" id="x<?php echo $tbl_stock_list->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($tbl_stock->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->MFG->EditValue ?>"<?php echo $tbl_stock->MFG->editAttributes() ?>>
<?php if (!$tbl_stock->MFG->ReadOnly && !$tbl_stock->MFG->Disabled && !isset($tbl_stock->MFG->EditAttrs["readonly"]) && !isset($tbl_stock->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_stocklist", "x<?php echo $tbl_stock_list->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_MFG" name="o<?php echo $tbl_stock_list->RowIndex ?>_MFG" id="o<?php echo $tbl_stock_list->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_stock->MFG->OldValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_MFG" class="form-group tbl_stock_MFG">
<span<?php echo $tbl_stock->MFG->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_stock->MFG->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_MFG" name="x<?php echo $tbl_stock_list->RowIndex ?>_MFG" id="x<?php echo $tbl_stock_list->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_stock->MFG->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_MFG" class="tbl_stock_MFG">
<span<?php echo $tbl_stock->MFG->viewAttributes() ?>>
<?php echo $tbl_stock->MFG->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_stock->Note_PalletId->Visible) { // Note_PalletId ?>
		<td data-name="Note_PalletId"<?php echo $tbl_stock->Note_PalletId->cellAttributes() ?>>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_Note_PalletId" class="form-group tbl_stock_Note_PalletId">
<input type="text" data-table="tbl_stock" data-field="x_Note_PalletId" name="x<?php echo $tbl_stock_list->RowIndex ?>_Note_PalletId" id="x<?php echo $tbl_stock_list->RowIndex ?>_Note_PalletId" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_stock->Note_PalletId->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Note_PalletId->EditValue ?>"<?php echo $tbl_stock->Note_PalletId->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_Note_PalletId" name="o<?php echo $tbl_stock_list->RowIndex ?>_Note_PalletId" id="o<?php echo $tbl_stock_list->RowIndex ?>_Note_PalletId" value="<?php echo HtmlEncode($tbl_stock->Note_PalletId->OldValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_Note_PalletId" class="form-group tbl_stock_Note_PalletId">
<input type="text" data-table="tbl_stock" data-field="x_Note_PalletId" name="x<?php echo $tbl_stock_list->RowIndex ?>_Note_PalletId" id="x<?php echo $tbl_stock_list->RowIndex ?>_Note_PalletId" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_stock->Note_PalletId->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Note_PalletId->EditValue ?>"<?php echo $tbl_stock->Note_PalletId->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_Note_PalletId" class="tbl_stock_Note_PalletId">
<span<?php echo $tbl_stock->Note_PalletId->viewAttributes() ?>>
<?php echo $tbl_stock->Note_PalletId->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_stock->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_stock->CreateUser->cellAttributes() ?>>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_CreateUser" class="form-group tbl_stock_CreateUser">
<input type="text" data-table="tbl_stock" data-field="x_CreateUser" name="x<?php echo $tbl_stock_list->RowIndex ?>_CreateUser" id="x<?php echo $tbl_stock_list->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->CreateUser->EditValue ?>"<?php echo $tbl_stock->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_CreateUser" name="o<?php echo $tbl_stock_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_stock_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_stock->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_CreateUser" class="form-group tbl_stock_CreateUser">
<span<?php echo $tbl_stock->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_stock->CreateUser->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_CreateUser" name="x<?php echo $tbl_stock_list->RowIndex ?>_CreateUser" id="x<?php echo $tbl_stock_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_stock->CreateUser->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_CreateUser" class="tbl_stock_CreateUser">
<span<?php echo $tbl_stock->CreateUser->viewAttributes() ?>>
<?php echo $tbl_stock->CreateUser->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_stock->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_stock->CreateDate->cellAttributes() ?>>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_CreateDate" class="form-group tbl_stock_CreateDate">
<input type="text" data-table="tbl_stock" data-field="x_CreateDate" data-format="11" name="x<?php echo $tbl_stock_list->RowIndex ?>_CreateDate" id="x<?php echo $tbl_stock_list->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_stock->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->CreateDate->EditValue ?>"<?php echo $tbl_stock->CreateDate->editAttributes() ?>>
<?php if (!$tbl_stock->CreateDate->ReadOnly && !$tbl_stock->CreateDate->Disabled && !isset($tbl_stock->CreateDate->EditAttrs["readonly"]) && !isset($tbl_stock->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_stocklist", "x<?php echo $tbl_stock_list->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_CreateDate" name="o<?php echo $tbl_stock_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_stock_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_stock->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_CreateDate" class="form-group tbl_stock_CreateDate">
<span<?php echo $tbl_stock->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_stock->CreateDate->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_CreateDate" name="x<?php echo $tbl_stock_list->RowIndex ?>_CreateDate" id="x<?php echo $tbl_stock_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_stock->CreateDate->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_stock->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_stock_list->RowCnt ?>_tbl_stock_CreateDate" class="tbl_stock_CreateDate">
<span<?php echo $tbl_stock->CreateDate->viewAttributes() ?>>
<?php echo $tbl_stock->CreateDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_stock_list->ListOptions->render("body", "right", $tbl_stock_list->RowCnt);
?>
	</tr>
<?php if ($tbl_stock->RowType == ROWTYPE_ADD || $tbl_stock->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_stocklist.updateLists(<?php echo $tbl_stock_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_stock->isGridAdd())
		if (!$tbl_stock_list->Recordset->EOF)
			$tbl_stock_list->Recordset->moveNext();
}
?>
<?php
	if ($tbl_stock->isGridAdd() || $tbl_stock->isGridEdit()) {
		$tbl_stock_list->RowIndex = '$rowindex$';
		$tbl_stock_list->loadRowValues();

		// Set row properties
		$tbl_stock->resetAttributes();
		$tbl_stock->RowAttrs = array_merge($tbl_stock->RowAttrs, array('data-rowindex'=>$tbl_stock_list->RowIndex, 'id'=>'r0_tbl_stock', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_stock->RowAttrs["class"], "ew-template");
		$tbl_stock->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_stock_list->renderRow();

		// Render list options
		$tbl_stock_list->renderListOptions();
		$tbl_stock_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_stock->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_stock_list->ListOptions->render("body", "left", $tbl_stock_list->RowIndex);
?>
	<?php if ($tbl_stock->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID">
<span id="el$rowindex$_tbl_stock_PalletID" class="form-group tbl_stock_PalletID">
<input type="text" data-table="tbl_stock" data-field="x_PalletID" name="x<?php echo $tbl_stock_list->RowIndex ?>_PalletID" id="x<?php echo $tbl_stock_list->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->PalletID->EditValue ?>"<?php echo $tbl_stock->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_PalletID" name="o<?php echo $tbl_stock_list->RowIndex ?>_PalletID" id="o<?php echo $tbl_stock_list->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_stock->PalletID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_stock->Code->Visible) { // Code ?>
		<td data-name="Code">
<span id="el$rowindex$_tbl_stock_Code" class="form-group tbl_stock_Code">
<input type="text" data-table="tbl_stock" data-field="x_Code" name="x<?php echo $tbl_stock_list->RowIndex ?>_Code" id="x<?php echo $tbl_stock_list->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Code->EditValue ?>"<?php echo $tbl_stock->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_Code" name="o<?php echo $tbl_stock_list->RowIndex ?>_Code" id="o<?php echo $tbl_stock_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_stock->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_stock->IdType->Visible) { // IdType ?>
		<td data-name="IdType">
<span id="el$rowindex$_tbl_stock_IdType" class="form-group tbl_stock_IdType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_stock" data-field="x_IdType" data-value-separator="<?php echo $tbl_stock->IdType->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_stock_list->RowIndex ?>_IdType" name="x<?php echo $tbl_stock_list->RowIndex ?>_IdType"<?php echo $tbl_stock->IdType->editAttributes() ?>>
		<?php echo $tbl_stock->IdType->selectOptionListHtml("x<?php echo $tbl_stock_list->RowIndex ?>_IdType") ?>
	</select>
</div>
<?php echo $tbl_stock->IdType->Lookup->getParamTag("p_x" . $tbl_stock_list->RowIndex . "_IdType") ?>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_IdType" name="o<?php echo $tbl_stock_list->RowIndex ?>_IdType" id="o<?php echo $tbl_stock_list->RowIndex ?>_IdType" value="<?php echo HtmlEncode($tbl_stock->IdType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_stock->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location">
<span id="el$rowindex$_tbl_stock_ID_Location" class="form-group tbl_stock_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_stock->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_stock->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_stock_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_stock->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_stock->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_stock->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_stock->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_stock->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" id="x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_stock->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_stocklist.createAutoSuggest({"id":"x<?php echo $tbl_stock_list->RowIndex ?>_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_stock->ID_Location->Lookup->getParamTag("p_x" . $tbl_stock_list->RowIndex . "_ID_Location") ?>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_ID_Location" name="o<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" id="o<?php echo $tbl_stock_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_stock->ID_Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_stock->Pcs_RemainPicking->Visible) { // Pcs_RemainPicking ?>
		<td data-name="Pcs_RemainPicking">
<span id="el$rowindex$_tbl_stock_Pcs_RemainPicking" class="form-group tbl_stock_Pcs_RemainPicking">
<input type="text" data-table="tbl_stock" data-field="x_Pcs_RemainPicking" name="x<?php echo $tbl_stock_list->RowIndex ?>_Pcs_RemainPicking" id="x<?php echo $tbl_stock_list->RowIndex ?>_Pcs_RemainPicking" size="3" placeholder="<?php echo HtmlEncode($tbl_stock->Pcs_RemainPicking->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Pcs_RemainPicking->EditValue ?>"<?php echo $tbl_stock->Pcs_RemainPicking->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_Pcs_RemainPicking" name="o<?php echo $tbl_stock_list->RowIndex ?>_Pcs_RemainPicking" id="o<?php echo $tbl_stock_list->RowIndex ?>_Pcs_RemainPicking" value="<?php echo HtmlEncode($tbl_stock->Pcs_RemainPicking->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_stock->MFG->Visible) { // MFG ?>
		<td data-name="MFG">
<span id="el$rowindex$_tbl_stock_MFG" class="form-group tbl_stock_MFG">
<input type="text" data-table="tbl_stock" data-field="x_MFG" data-format="7" name="x<?php echo $tbl_stock_list->RowIndex ?>_MFG" id="x<?php echo $tbl_stock_list->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($tbl_stock->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->MFG->EditValue ?>"<?php echo $tbl_stock->MFG->editAttributes() ?>>
<?php if (!$tbl_stock->MFG->ReadOnly && !$tbl_stock->MFG->Disabled && !isset($tbl_stock->MFG->EditAttrs["readonly"]) && !isset($tbl_stock->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_stocklist", "x<?php echo $tbl_stock_list->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_MFG" name="o<?php echo $tbl_stock_list->RowIndex ?>_MFG" id="o<?php echo $tbl_stock_list->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_stock->MFG->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_stock->Note_PalletId->Visible) { // Note_PalletId ?>
		<td data-name="Note_PalletId">
<span id="el$rowindex$_tbl_stock_Note_PalletId" class="form-group tbl_stock_Note_PalletId">
<input type="text" data-table="tbl_stock" data-field="x_Note_PalletId" name="x<?php echo $tbl_stock_list->RowIndex ?>_Note_PalletId" id="x<?php echo $tbl_stock_list->RowIndex ?>_Note_PalletId" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_stock->Note_PalletId->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Note_PalletId->EditValue ?>"<?php echo $tbl_stock->Note_PalletId->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_Note_PalletId" name="o<?php echo $tbl_stock_list->RowIndex ?>_Note_PalletId" id="o<?php echo $tbl_stock_list->RowIndex ?>_Note_PalletId" value="<?php echo HtmlEncode($tbl_stock->Note_PalletId->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_stock->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<span id="el$rowindex$_tbl_stock_CreateUser" class="form-group tbl_stock_CreateUser">
<input type="text" data-table="tbl_stock" data-field="x_CreateUser" name="x<?php echo $tbl_stock_list->RowIndex ?>_CreateUser" id="x<?php echo $tbl_stock_list->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->CreateUser->EditValue ?>"<?php echo $tbl_stock->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_CreateUser" name="o<?php echo $tbl_stock_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_stock_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_stock->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_stock->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<span id="el$rowindex$_tbl_stock_CreateDate" class="form-group tbl_stock_CreateDate">
<input type="text" data-table="tbl_stock" data-field="x_CreateDate" data-format="11" name="x<?php echo $tbl_stock_list->RowIndex ?>_CreateDate" id="x<?php echo $tbl_stock_list->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_stock->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->CreateDate->EditValue ?>"<?php echo $tbl_stock->CreateDate->editAttributes() ?>>
<?php if (!$tbl_stock->CreateDate->ReadOnly && !$tbl_stock->CreateDate->Disabled && !isset($tbl_stock->CreateDate->EditAttrs["readonly"]) && !isset($tbl_stock->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_stocklist", "x<?php echo $tbl_stock_list->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_CreateDate" name="o<?php echo $tbl_stock_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_stock_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_stock->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_stock_list->ListOptions->render("body", "right", $tbl_stock_list->RowIndex);
?>
<script>
ftbl_stocklist.updateLists(<?php echo $tbl_stock_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_stock->RowType = ROWTYPE_AGGREGATE;
$tbl_stock->resetAttributes();
$tbl_stock_list->renderRow();
?>
<?php if ($tbl_stock_list->TotalRecs > 0 && !$tbl_stock->isGridAdd() && !$tbl_stock->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_stock_list->renderListOptions();

// Render list options (footer, left)
$tbl_stock_list->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_stock->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $tbl_stock->PalletID->footerCellClass() ?>"><span id="elf_tbl_stock_PalletID" class="tbl_stock_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_stock->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_stock->Code->footerCellClass() ?>"><span id="elf_tbl_stock_Code" class="tbl_stock_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_stock->IdType->Visible) { // IdType ?>
		<td data-name="IdType" class="<?php echo $tbl_stock->IdType->footerCellClass() ?>"><span id="elf_tbl_stock_IdType" class="tbl_stock_IdType">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_stock->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location" class="<?php echo $tbl_stock->ID_Location->footerCellClass() ?>"><span id="elf_tbl_stock_ID_Location" class="tbl_stock_ID_Location">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_stock->Pcs_RemainPicking->Visible) { // Pcs_RemainPicking ?>
		<td data-name="Pcs_RemainPicking" class="<?php echo $tbl_stock->Pcs_RemainPicking->footerCellClass() ?>"><span id="elf_tbl_stock_Pcs_RemainPicking" class="tbl_stock_Pcs_RemainPicking">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_stock->Pcs_RemainPicking->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_stock->MFG->Visible) { // MFG ?>
		<td data-name="MFG" class="<?php echo $tbl_stock->MFG->footerCellClass() ?>"><span id="elf_tbl_stock_MFG" class="tbl_stock_MFG">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_stock->Note_PalletId->Visible) { // Note_PalletId ?>
		<td data-name="Note_PalletId" class="<?php echo $tbl_stock->Note_PalletId->footerCellClass() ?>"><span id="elf_tbl_stock_Note_PalletId" class="tbl_stock_Note_PalletId">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_stock->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $tbl_stock->CreateUser->footerCellClass() ?>"><span id="elf_tbl_stock_CreateUser" class="tbl_stock_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_stock->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $tbl_stock->CreateDate->footerCellClass() ?>"><span id="elf_tbl_stock_CreateDate" class="tbl_stock_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_stock_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_stock->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $tbl_stock_list->FormKeyCountName ?>" id="<?php echo $tbl_stock_list->FormKeyCountName ?>" value="<?php echo $tbl_stock_list->KeyCount ?>">
<?php echo $tbl_stock_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$tbl_stock->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_stock_list->Recordset)
	$tbl_stock_list->Recordset->Close();
?>
<?php if (!$tbl_stock->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_stock->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_stock_list->Pager)) $tbl_stock_list->Pager = new PrevNextPager($tbl_stock_list->StartRec, $tbl_stock_list->DisplayRecs, $tbl_stock_list->TotalRecs, $tbl_stock_list->AutoHidePager) ?>
<?php if ($tbl_stock_list->Pager->RecordCount > 0 && $tbl_stock_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_stock_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_stock_list->pageUrl() ?>start=<?php echo $tbl_stock_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_stock_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_stock_list->pageUrl() ?>start=<?php echo $tbl_stock_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_stock_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_stock_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_stock_list->pageUrl() ?>start=<?php echo $tbl_stock_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_stock_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_stock_list->pageUrl() ?>start=<?php echo $tbl_stock_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_stock_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_stock_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_stock_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_stock_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_stock_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_stock_list->TotalRecs > 0 && (!$tbl_stock_list->AutoHidePageSizeSelector || $tbl_stock_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_stock">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_stock_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_stock_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_stock_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_stock_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_stock_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_stock->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_stock_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_stock_list->TotalRecs == 0 && !$tbl_stock->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_stock_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_stock_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_stock->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_stock_list->terminate();
?>