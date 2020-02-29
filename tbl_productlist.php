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
$tbl_product_list = new tbl_product_list();

// Run the page
$tbl_product_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_product->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_productlist = currentForm = new ew.Form("ftbl_productlist", "list");
ftbl_productlist.formKeyCountName = '<?php echo $tbl_product_list->FormKeyCountName ?>';

// Validate form
ftbl_productlist.validate = function() {
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
		var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
		<?php if ($tbl_product_list->IdType->Required) { ?>
			elm = this.getElements("x" + infix + "_IdType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->IdType->caption(), $tbl_product->IdType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_list->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->Code->caption(), $tbl_product->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_list->Model->Required) { ?>
			elm = this.getElements("x" + infix + "_Model");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->Model->caption(), $tbl_product->Model->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_list->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->ProductName->caption(), $tbl_product->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_list->VnName->Required) { ?>
			elm = this.getElements("x" + infix + "_VnName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->VnName->caption(), $tbl_product->VnName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_list->ID_Contact->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Contact");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->ID_Contact->caption(), $tbl_product->ID_Contact->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_list->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->Description->caption(), $tbl_product->Description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_list->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->CreateDate->caption(), $tbl_product->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_list->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->CreateUser->caption(), $tbl_product->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		ew.alert(ew.language.phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
ftbl_productlist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "IdType", false)) return false;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "Model", false)) return false;
	if (ew.valueChanged(fobj, infix, "ProductName", false)) return false;
	if (ew.valueChanged(fobj, infix, "VnName", false)) return false;
	if (ew.valueChanged(fobj, infix, "ID_Contact", false)) return false;
	if (ew.valueChanged(fobj, infix, "Description", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateDate", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateUser", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_productlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_productlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_productlist.lists["x_IdType"] = <?php echo $tbl_product_list->IdType->Lookup->toClientList() ?>;
ftbl_productlist.lists["x_IdType"].options = <?php echo JsonEncode($tbl_product_list->IdType->lookupOptions()) ?>;
ftbl_productlist.lists["x_ID_Contact"] = <?php echo $tbl_product_list->ID_Contact->Lookup->toClientList() ?>;
ftbl_productlist.lists["x_ID_Contact"].options = <?php echo JsonEncode($tbl_product_list->ID_Contact->lookupOptions()) ?>;
ftbl_productlist.autoSuggests["x_ID_Contact"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var ftbl_productlistsrch = currentSearchForm = new ew.Form("ftbl_productlistsrch");

// Validate function for search
ftbl_productlistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ftbl_productlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_productlistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_productlistsrch.lists["x_IdType"] = <?php echo $tbl_product_list->IdType->Lookup->toClientList() ?>;
ftbl_productlistsrch.lists["x_IdType"].options = <?php echo JsonEncode($tbl_product_list->IdType->lookupOptions()) ?>;

// Filters
ftbl_productlistsrch.filterList = <?php echo $tbl_product_list->getFilterList() ?>;
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
<script src="phpjs/ewscrolltable.js"></script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_product->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_product_list->TotalRecs > 0 && $tbl_product_list->ExportOptions->visible()) { ?>
<?php $tbl_product_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_product_list->ImportOptions->visible()) { ?>
<?php $tbl_product_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_product_list->SearchOptions->visible()) { ?>
<?php $tbl_product_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_product_list->FilterOptions->visible()) { ?>
<?php $tbl_product_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>

<?php
$tbl_product_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_product->isExport() && !$tbl_product->CurrentAction) { ?>
<form name="ftbl_productlistsrch" id="ftbl_productlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_product_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_productlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_product">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$tbl_product_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_product->RowType = ROWTYPE_SEARCH;

// Render row
$tbl_product->resetAttributes();
$tbl_product_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($tbl_product->IdType->Visible) { // IdType ?>
	<div id="xsc_IdType" class="ew-cell form-group">
		<label for="x_IdType" class="ew-search-caption ew-label"><?php echo $tbl_product->IdType->caption() ?></label>
		<span class="ew-search-operator"><?php // echo $Language->phrase("LIKE") ?><input type="hidden" name="z_IdType" id="z_IdType" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product" data-field="x_IdType" data-value-separator="<?php echo $tbl_product->IdType->displayValueSeparatorAttribute() ?>" id="x_IdType" name="x_IdType"<?php echo $tbl_product->IdType->editAttributes() ?>>
		<?php echo $tbl_product->IdType->selectOptionListHtml("x_IdType") ?>
	</select>
</div>
<?php echo $tbl_product->IdType->Lookup->getParamTag("p_x_IdType") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_product_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_product_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_product_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_product_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_product_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_product_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_product_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_product_list->showPageHeader(); ?>
<?php
$tbl_product_list->showMessage();
?>
<input type="button" id="btnImport" data-toggle="modal" data-target="#myModal" value="Import" class="btn btn-outline-danger btnx" title="Import excel (*.xlsx)" hienThi="tooltip">
<a href="ImportProduct.xlsx" class="btn btn-outline-danger btnxx" thongtin="tooltip" title="Download template excel file">Template</a>
<?php if ($tbl_product_list->TotalRecs > 0 || $tbl_product->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_product_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_product">
<?php if (!$tbl_product->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_product->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_product_list->Pager)) $tbl_product_list->Pager = new PrevNextPager($tbl_product_list->StartRec, $tbl_product_list->DisplayRecs, $tbl_product_list->TotalRecs, $tbl_product_list->AutoHidePager) ?>
<?php if ($tbl_product_list->Pager->RecordCount > 0 && $tbl_product_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_product_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_product_list->pageUrl() ?>start=<?php echo $tbl_product_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_product_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_product_list->pageUrl() ?>start=<?php echo $tbl_product_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_product_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_product_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_product_list->pageUrl() ?>start=<?php echo $tbl_product_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_product_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_product_list->pageUrl() ?>start=<?php echo $tbl_product_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_product_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_product_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_product_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_product_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_product_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_product_list->TotalRecs > 0 && (!$tbl_product_list->AutoHidePageSizeSelector || $tbl_product_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_product">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_product_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_product_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_product_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_product_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_product_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_product->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_product_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_productlist" id="ftbl_productlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_product_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_product_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_product" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_product_list->TotalRecs > 0 || $tbl_product->isAdd() || $tbl_product->isCopy() || $tbl_product->isGridEdit()) { ?>
<table id="tbl_tbl_productlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_product_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_product_list->renderListOptions();

// Render list options (header, left)
$tbl_product_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_product->IdType->Visible) { // IdType ?>
	<?php if ($tbl_product->sortUrl($tbl_product->IdType) == "") { ?>
		<th data-name="IdType" class="<?php echo $tbl_product->IdType->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_IdType" class="tbl_product_IdType"><div class="ew-table-header-caption"><?php echo $tbl_product->IdType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IdType" class="<?php echo $tbl_product->IdType->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->IdType) ?>',2);"><div id="elh_tbl_product_IdType" class="tbl_product_IdType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product->IdType->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_product->IdType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product->IdType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->Code->Visible) { // Code ?>
	<?php if ($tbl_product->sortUrl($tbl_product->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_product->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_Code" class="tbl_product_Code"><div class="ew-table-header-caption"><?php echo $tbl_product->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_product->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->Code) ?>',2);"><div id="elh_tbl_product_Code" class="tbl_product_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_product->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->Model->Visible) { // Model ?>
	<?php if ($tbl_product->sortUrl($tbl_product->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $tbl_product->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_Model" class="tbl_product_Model"><div class="ew-table-header-caption"><?php echo $tbl_product->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $tbl_product->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->Model) ?>',2);"><div id="elh_tbl_product_Model" class="tbl_product_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_product->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->ProductName->Visible) { // ProductName ?>
	<?php if ($tbl_product->sortUrl($tbl_product->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $tbl_product->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_ProductName" class="tbl_product_ProductName"><div class="ew-table-header-caption"><?php echo $tbl_product->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $tbl_product->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->ProductName) ?>',2);"><div id="elh_tbl_product_ProductName" class="tbl_product_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_product->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->VnName->Visible) { // VnName ?>
	<?php if ($tbl_product->sortUrl($tbl_product->VnName) == "") { ?>
		<th data-name="VnName" class="<?php echo $tbl_product->VnName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_VnName" class="tbl_product_VnName"><div class="ew-table-header-caption"><?php echo $tbl_product->VnName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VnName" class="<?php echo $tbl_product->VnName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->VnName) ?>',2);"><div id="elh_tbl_product_VnName" class="tbl_product_VnName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product->VnName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_product->VnName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product->VnName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->ID_Contact->Visible) { // ID_Contact ?>
	<?php if ($tbl_product->sortUrl($tbl_product->ID_Contact) == "") { ?>
		<th data-name="ID_Contact" class="<?php echo $tbl_product->ID_Contact->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_ID_Contact" class="tbl_product_ID_Contact"><div class="ew-table-header-caption"><?php echo $tbl_product->ID_Contact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Contact" class="<?php echo $tbl_product->ID_Contact->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->ID_Contact) ?>',2);"><div id="elh_tbl_product_ID_Contact" class="tbl_product_ID_Contact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product->ID_Contact->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_product->ID_Contact->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product->ID_Contact->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->Description->Visible) { // Description ?>
	<?php if ($tbl_product->sortUrl($tbl_product->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $tbl_product->Description->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_Description" class="tbl_product_Description"><div class="ew-table-header-caption"><?php echo $tbl_product->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $tbl_product->Description->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->Description) ?>',2);"><div id="elh_tbl_product_Description" class="tbl_product_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product->Description->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_product->Description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product->Description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_product->sortUrl($tbl_product->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_product->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_CreateDate" class="tbl_product_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_product->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_product->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->CreateDate) ?>',2);"><div id="elh_tbl_product_CreateDate" class="tbl_product_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_product->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_product->sortUrl($tbl_product->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_product->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_CreateUser" class="tbl_product_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_product->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_product->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->CreateUser) ?>',2);"><div id="elh_tbl_product_CreateUser" class="tbl_product_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_product->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_product_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($tbl_product->isAdd() || $tbl_product->isCopy()) {
		$tbl_product_list->RowIndex = 0;
		$tbl_product_list->KeyCount = $tbl_product_list->RowIndex;
		if ($tbl_product->isAdd())
			$tbl_product_list->loadRowValues();
		if ($tbl_product->EventCancelled) // Insert failed
			$tbl_product_list->restoreFormValues(); // Restore form values

		// Set row properties
		$tbl_product->resetAttributes();
		$tbl_product->RowAttrs = array_merge($tbl_product->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_tbl_product', 'data-rowtype'=>ROWTYPE_ADD));
		$tbl_product->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_product_list->renderRow();

		// Render list options
		$tbl_product_list->renderListOptions();
		$tbl_product_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_product->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_product_list->ListOptions->render("body", "left", $tbl_product_list->RowCnt);
?>
	<?php if ($tbl_product->IdType->Visible) { // IdType ?>
		<td data-name="IdType">
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_IdType" class="form-group tbl_product_IdType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product" data-field="x_IdType" data-value-separator="<?php echo $tbl_product->IdType->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_product_list->RowIndex ?>_IdType" name="x<?php echo $tbl_product_list->RowIndex ?>_IdType"<?php echo $tbl_product->IdType->editAttributes() ?>>
		<?php echo $tbl_product->IdType->selectOptionListHtml("x<?php echo $tbl_product_list->RowIndex ?>_IdType") ?>
	</select>
<?php if (AllowAdd(CurrentProjectID() . "tbl_producttype") && !$tbl_product->IdType->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $tbl_product_list->RowIndex ?>_IdType" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $tbl_product->IdType->caption() ?>" data-title="<?php echo $tbl_product->IdType->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $tbl_product_list->RowIndex ?>_IdType',url:'tbl_producttypeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
</div>
<?php echo $tbl_product->IdType->Lookup->getParamTag("p_x" . $tbl_product_list->RowIndex . "_IdType") ?>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_IdType" name="o<?php echo $tbl_product_list->RowIndex ?>_IdType" id="o<?php echo $tbl_product_list->RowIndex ?>_IdType" value="<?php echo HtmlEncode($tbl_product->IdType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->Code->Visible) { // Code ?>
		<td data-name="Code">
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Code" class="form-group tbl_product_Code">
<input type="text" data-table="tbl_product" data-field="x_Code" name="x<?php echo $tbl_product_list->RowIndex ?>_Code" id="x<?php echo $tbl_product_list->RowIndex ?>_Code" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Code->EditValue ?>"<?php echo $tbl_product->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Code" name="o<?php echo $tbl_product_list->RowIndex ?>_Code" id="o<?php echo $tbl_product_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_product->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->Model->Visible) { // Model ?>
		<td data-name="Model">
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Model" class="form-group tbl_product_Model">
<input type="text" data-table="tbl_product" data-field="x_Model" name="x<?php echo $tbl_product_list->RowIndex ?>_Model" id="x<?php echo $tbl_product_list->RowIndex ?>_Model" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->Model->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Model->EditValue ?>"<?php echo $tbl_product->Model->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Model" name="o<?php echo $tbl_product_list->RowIndex ?>_Model" id="o<?php echo $tbl_product_list->RowIndex ?>_Model" value="<?php echo HtmlEncode($tbl_product->Model->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName">
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_ProductName" class="form-group tbl_product_ProductName">
<input type="text" data-table="tbl_product" data-field="x_ProductName" name="x<?php echo $tbl_product_list->RowIndex ?>_ProductName" id="x<?php echo $tbl_product_list->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->ProductName->EditValue ?>"<?php echo $tbl_product->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ProductName" name="o<?php echo $tbl_product_list->RowIndex ?>_ProductName" id="o<?php echo $tbl_product_list->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_product->ProductName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->VnName->Visible) { // VnName ?>
		<td data-name="VnName">
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_VnName" class="form-group tbl_product_VnName">
<input type="text" data-table="tbl_product" data-field="x_VnName" name="x<?php echo $tbl_product_list->RowIndex ?>_VnName" id="x<?php echo $tbl_product_list->RowIndex ?>_VnName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->VnName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->VnName->EditValue ?>"<?php echo $tbl_product->VnName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_VnName" name="o<?php echo $tbl_product_list->RowIndex ?>_VnName" id="o<?php echo $tbl_product_list->RowIndex ?>_VnName" value="<?php echo HtmlEncode($tbl_product->VnName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->ID_Contact->Visible) { // ID_Contact ?>
		<td data-name="ID_Contact">
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_ID_Contact" class="form-group tbl_product_ID_Contact">
<?php
$wrkonchange = "" . trim(@$tbl_product->ID_Contact->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_product->ID_Contact->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_product_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="sv_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo RemoveHtml($tbl_product->ID_Contact->EditValue) ?>" size="20" placeholder="<?php echo HtmlEncode($tbl_product->ID_Contact->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_product->ID_Contact->getPlaceHolder()) ?>"<?php echo $tbl_product->ID_Contact->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ID_Contact" data-value-separator="<?php echo $tbl_product->ID_Contact->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo HtmlEncode($tbl_product->ID_Contact->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_productlist.createAutoSuggest({"id":"x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact","forceSelect":true});
</script>
<?php echo $tbl_product->ID_Contact->Lookup->getParamTag("p_x" . $tbl_product_list->RowIndex . "_ID_Contact") ?>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ID_Contact" name="o<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="o<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo HtmlEncode($tbl_product->ID_Contact->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->Description->Visible) { // Description ?>
		<td data-name="Description">
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Description" class="form-group tbl_product_Description">
<input type="text" data-table="tbl_product" data-field="x_Description" name="x<?php echo $tbl_product_list->RowIndex ?>_Description" id="x<?php echo $tbl_product_list->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Description->EditValue ?>"<?php echo $tbl_product->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Description" name="o<?php echo $tbl_product_list->RowIndex ?>_Description" id="o<?php echo $tbl_product_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_product->Description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_CreateDate" class="form-group tbl_product_CreateDate">
<input type="text" data-table="tbl_product" data-field="x_CreateDate" data-format="11" name="x<?php echo $tbl_product_list->RowIndex ?>_CreateDate" id="x<?php echo $tbl_product_list->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_product->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_product->CreateDate->EditValue ?>"<?php echo $tbl_product->CreateDate->editAttributes() ?>>
<?php if (!$tbl_product->CreateDate->ReadOnly && !$tbl_product->CreateDate->Disabled && !isset($tbl_product->CreateDate->EditAttrs["readonly"]) && !isset($tbl_product->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_productlist", "x<?php echo $tbl_product_list->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_CreateDate" name="o<?php echo $tbl_product_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_product_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_product->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_CreateUser" class="form-group tbl_product_CreateUser">
<input type="text" data-table="tbl_product" data-field="x_CreateUser" name="x<?php echo $tbl_product_list->RowIndex ?>_CreateUser" id="x<?php echo $tbl_product_list->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_product->CreateUser->EditValue ?>"<?php echo $tbl_product->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_CreateUser" name="o<?php echo $tbl_product_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_product_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_product->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_product_list->ListOptions->render("body", "right", $tbl_product_list->RowCnt);
?>
<script>
ftbl_productlist.updateLists(<?php echo $tbl_product_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($tbl_product->ExportAll && $tbl_product->isExport()) {
	$tbl_product_list->StopRec = $tbl_product_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_product_list->TotalRecs > $tbl_product_list->StartRec + $tbl_product_list->DisplayRecs - 1)
		$tbl_product_list->StopRec = $tbl_product_list->StartRec + $tbl_product_list->DisplayRecs - 1;
	else
		$tbl_product_list->StopRec = $tbl_product_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_product_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_product_list->FormKeyCountName) && ($tbl_product->isGridAdd() || $tbl_product->isGridEdit() || $tbl_product->isConfirm())) {
		$tbl_product_list->KeyCount = $CurrentForm->getValue($tbl_product_list->FormKeyCountName);
		$tbl_product_list->StopRec = $tbl_product_list->StartRec + $tbl_product_list->KeyCount - 1;
	}
}
$tbl_product_list->RecCnt = $tbl_product_list->StartRec - 1;
if ($tbl_product_list->Recordset && !$tbl_product_list->Recordset->EOF) {
	$tbl_product_list->Recordset->moveFirst();
	$selectLimit = $tbl_product_list->UseSelectLimit;
	if (!$selectLimit && $tbl_product_list->StartRec > 1)
		$tbl_product_list->Recordset->move($tbl_product_list->StartRec - 1);
} elseif (!$tbl_product->AllowAddDeleteRow && $tbl_product_list->StopRec == 0) {
	$tbl_product_list->StopRec = $tbl_product->GridAddRowCount;
}

// Initialize aggregate
$tbl_product->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_product->resetAttributes();
$tbl_product_list->renderRow();
$tbl_product_list->EditRowCnt = 0;
if ($tbl_product->isEdit())
	$tbl_product_list->RowIndex = 1;
if ($tbl_product->isGridAdd())
	$tbl_product_list->RowIndex = 0;
if ($tbl_product->isGridEdit())
	$tbl_product_list->RowIndex = 0;
while ($tbl_product_list->RecCnt < $tbl_product_list->StopRec) {
	$tbl_product_list->RecCnt++;
	if ($tbl_product_list->RecCnt >= $tbl_product_list->StartRec) {
		$tbl_product_list->RowCnt++;
		if ($tbl_product->isGridAdd() || $tbl_product->isGridEdit() || $tbl_product->isConfirm()) {
			$tbl_product_list->RowIndex++;
			$CurrentForm->Index = $tbl_product_list->RowIndex;
			if ($CurrentForm->hasValue($tbl_product_list->FormActionName) && $tbl_product_list->EventCancelled)
				$tbl_product_list->RowAction = strval($CurrentForm->getValue($tbl_product_list->FormActionName));
			elseif ($tbl_product->isGridAdd())
				$tbl_product_list->RowAction = "insert";
			else
				$tbl_product_list->RowAction = "";
		}

		// Set up key count
		$tbl_product_list->KeyCount = $tbl_product_list->RowIndex;

		// Init row class and style
		$tbl_product->resetAttributes();
		$tbl_product->CssClass = "";
		if ($tbl_product->isGridAdd()) {
			$tbl_product_list->loadRowValues(); // Load default values
		} else {
			$tbl_product_list->loadRowValues($tbl_product_list->Recordset); // Load row values
		}
		$tbl_product->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_product->isGridAdd()) // Grid add
			$tbl_product->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_product->isGridAdd() && $tbl_product->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_product_list->restoreCurrentRowFormValues($tbl_product_list->RowIndex); // Restore form values
		if ($tbl_product->isEdit()) {
			if ($tbl_product_list->checkInlineEditKey() && $tbl_product_list->EditRowCnt == 0) { // Inline edit
				$tbl_product->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_product->isGridEdit()) { // Grid edit
			if ($tbl_product->EventCancelled)
				$tbl_product_list->restoreCurrentRowFormValues($tbl_product_list->RowIndex); // Restore form values
			if ($tbl_product_list->RowAction == "insert")
				$tbl_product->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_product->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_product->isEdit() && $tbl_product->RowType == ROWTYPE_EDIT && $tbl_product->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_product_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_product->isGridEdit() && ($tbl_product->RowType == ROWTYPE_EDIT || $tbl_product->RowType == ROWTYPE_ADD) && $tbl_product->EventCancelled) // Update failed
			$tbl_product_list->restoreCurrentRowFormValues($tbl_product_list->RowIndex); // Restore form values
		if ($tbl_product->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_product_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_product->RowAttrs = array_merge($tbl_product->RowAttrs, array('data-rowindex'=>$tbl_product_list->RowCnt, 'id'=>'r' . $tbl_product_list->RowCnt . '_tbl_product', 'data-rowtype'=>$tbl_product->RowType));

		// Render row
		$tbl_product_list->renderRow();

		// Render list options
		$tbl_product_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_product_list->RowAction <> "delete" && $tbl_product_list->RowAction <> "insertdelete" && !($tbl_product_list->RowAction == "insert" && $tbl_product->isConfirm() && $tbl_product_list->emptyRow())) {
?>
	<tr<?php echo $tbl_product->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_product_list->ListOptions->render("body", "left", $tbl_product_list->RowCnt);
?>
	<?php if ($tbl_product->IdType->Visible) { // IdType ?>
		<td data-name="IdType"<?php echo $tbl_product->IdType->cellAttributes() ?>>
<?php if ($tbl_product->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_IdType" class="form-group tbl_product_IdType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product" data-field="x_IdType" data-value-separator="<?php echo $tbl_product->IdType->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_product_list->RowIndex ?>_IdType" name="x<?php echo $tbl_product_list->RowIndex ?>_IdType"<?php echo $tbl_product->IdType->editAttributes() ?>>
		<?php echo $tbl_product->IdType->selectOptionListHtml("x<?php echo $tbl_product_list->RowIndex ?>_IdType") ?>
	</select>
<?php if (AllowAdd(CurrentProjectID() . "tbl_producttype") && !$tbl_product->IdType->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $tbl_product_list->RowIndex ?>_IdType" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $tbl_product->IdType->caption() ?>" data-title="<?php echo $tbl_product->IdType->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $tbl_product_list->RowIndex ?>_IdType',url:'tbl_producttypeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
</div>
<?php echo $tbl_product->IdType->Lookup->getParamTag("p_x" . $tbl_product_list->RowIndex . "_IdType") ?>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_IdType" name="o<?php echo $tbl_product_list->RowIndex ?>_IdType" id="o<?php echo $tbl_product_list->RowIndex ?>_IdType" value="<?php echo HtmlEncode($tbl_product->IdType->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_IdType" class="form-group tbl_product_IdType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product" data-field="x_IdType" data-value-separator="<?php echo $tbl_product->IdType->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_product_list->RowIndex ?>_IdType" name="x<?php echo $tbl_product_list->RowIndex ?>_IdType"<?php echo $tbl_product->IdType->editAttributes() ?>>
		<?php echo $tbl_product->IdType->selectOptionListHtml("x<?php echo $tbl_product_list->RowIndex ?>_IdType") ?>
	</select>
<?php if (AllowAdd(CurrentProjectID() . "tbl_producttype") && !$tbl_product->IdType->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $tbl_product_list->RowIndex ?>_IdType" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $tbl_product->IdType->caption() ?>" data-title="<?php echo $tbl_product->IdType->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $tbl_product_list->RowIndex ?>_IdType',url:'tbl_producttypeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
</div>
<?php echo $tbl_product->IdType->Lookup->getParamTag("p_x" . $tbl_product_list->RowIndex . "_IdType") ?>
</span>
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_IdType" class="tbl_product_IdType">
<span<?php echo $tbl_product->IdType->viewAttributes() ?>>
<?php echo $tbl_product->IdType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_product->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_product->Code->cellAttributes() ?>>
<?php if ($tbl_product->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Code" class="form-group tbl_product_Code">
<input type="text" data-table="tbl_product" data-field="x_Code" name="x<?php echo $tbl_product_list->RowIndex ?>_Code" id="x<?php echo $tbl_product_list->RowIndex ?>_Code" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Code->EditValue ?>"<?php echo $tbl_product->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Code" name="o<?php echo $tbl_product_list->RowIndex ?>_Code" id="o<?php echo $tbl_product_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_product->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Code" class="form-group tbl_product_Code">
<span<?php echo $tbl_product->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_product->Code->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Code" name="x<?php echo $tbl_product_list->RowIndex ?>_Code" id="x<?php echo $tbl_product_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_product->Code->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Code" class="tbl_product_Code">
<span<?php echo $tbl_product->Code->viewAttributes() ?>>
<?php echo $tbl_product->Code->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_product->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $tbl_product->Model->cellAttributes() ?>>
<?php if ($tbl_product->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Model" class="form-group tbl_product_Model">
<input type="text" data-table="tbl_product" data-field="x_Model" name="x<?php echo $tbl_product_list->RowIndex ?>_Model" id="x<?php echo $tbl_product_list->RowIndex ?>_Model" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->Model->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Model->EditValue ?>"<?php echo $tbl_product->Model->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Model" name="o<?php echo $tbl_product_list->RowIndex ?>_Model" id="o<?php echo $tbl_product_list->RowIndex ?>_Model" value="<?php echo HtmlEncode($tbl_product->Model->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Model" class="form-group tbl_product_Model">
<input type="text" data-table="tbl_product" data-field="x_Model" name="x<?php echo $tbl_product_list->RowIndex ?>_Model" id="x<?php echo $tbl_product_list->RowIndex ?>_Model" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->Model->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Model->EditValue ?>"<?php echo $tbl_product->Model->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Model" class="tbl_product_Model">
<span<?php echo $tbl_product->Model->viewAttributes() ?>>
<?php echo $tbl_product->Model->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_product->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $tbl_product->ProductName->cellAttributes() ?>>
<?php if ($tbl_product->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_ProductName" class="form-group tbl_product_ProductName">
<input type="text" data-table="tbl_product" data-field="x_ProductName" name="x<?php echo $tbl_product_list->RowIndex ?>_ProductName" id="x<?php echo $tbl_product_list->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->ProductName->EditValue ?>"<?php echo $tbl_product->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ProductName" name="o<?php echo $tbl_product_list->RowIndex ?>_ProductName" id="o<?php echo $tbl_product_list->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_product->ProductName->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_ProductName" class="form-group tbl_product_ProductName">
<input type="text" data-table="tbl_product" data-field="x_ProductName" name="x<?php echo $tbl_product_list->RowIndex ?>_ProductName" id="x<?php echo $tbl_product_list->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->ProductName->EditValue ?>"<?php echo $tbl_product->ProductName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_ProductName" class="tbl_product_ProductName">
<span<?php echo $tbl_product->ProductName->viewAttributes() ?>>
<?php echo $tbl_product->ProductName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_product->VnName->Visible) { // VnName ?>
		<td data-name="VnName"<?php echo $tbl_product->VnName->cellAttributes() ?>>
<?php if ($tbl_product->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_VnName" class="form-group tbl_product_VnName">
<input type="text" data-table="tbl_product" data-field="x_VnName" name="x<?php echo $tbl_product_list->RowIndex ?>_VnName" id="x<?php echo $tbl_product_list->RowIndex ?>_VnName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->VnName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->VnName->EditValue ?>"<?php echo $tbl_product->VnName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_VnName" name="o<?php echo $tbl_product_list->RowIndex ?>_VnName" id="o<?php echo $tbl_product_list->RowIndex ?>_VnName" value="<?php echo HtmlEncode($tbl_product->VnName->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_VnName" class="form-group tbl_product_VnName">
<input type="text" data-table="tbl_product" data-field="x_VnName" name="x<?php echo $tbl_product_list->RowIndex ?>_VnName" id="x<?php echo $tbl_product_list->RowIndex ?>_VnName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->VnName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->VnName->EditValue ?>"<?php echo $tbl_product->VnName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_VnName" class="tbl_product_VnName">
<span<?php echo $tbl_product->VnName->viewAttributes() ?>>
<?php echo $tbl_product->VnName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_product->ID_Contact->Visible) { // ID_Contact ?>
		<td data-name="ID_Contact"<?php echo $tbl_product->ID_Contact->cellAttributes() ?>>
<?php if ($tbl_product->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_ID_Contact" class="form-group tbl_product_ID_Contact">
<?php
$wrkonchange = "" . trim(@$tbl_product->ID_Contact->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_product->ID_Contact->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_product_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="sv_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo RemoveHtml($tbl_product->ID_Contact->EditValue) ?>" size="20" placeholder="<?php echo HtmlEncode($tbl_product->ID_Contact->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_product->ID_Contact->getPlaceHolder()) ?>"<?php echo $tbl_product->ID_Contact->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ID_Contact" data-value-separator="<?php echo $tbl_product->ID_Contact->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo HtmlEncode($tbl_product->ID_Contact->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_productlist.createAutoSuggest({"id":"x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact","forceSelect":true});
</script>
<?php echo $tbl_product->ID_Contact->Lookup->getParamTag("p_x" . $tbl_product_list->RowIndex . "_ID_Contact") ?>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ID_Contact" name="o<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="o<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo HtmlEncode($tbl_product->ID_Contact->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_ID_Contact" class="form-group tbl_product_ID_Contact">
<?php
$wrkonchange = "" . trim(@$tbl_product->ID_Contact->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_product->ID_Contact->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_product_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="sv_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo RemoveHtml($tbl_product->ID_Contact->EditValue) ?>" size="20" placeholder="<?php echo HtmlEncode($tbl_product->ID_Contact->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_product->ID_Contact->getPlaceHolder()) ?>"<?php echo $tbl_product->ID_Contact->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ID_Contact" data-value-separator="<?php echo $tbl_product->ID_Contact->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo HtmlEncode($tbl_product->ID_Contact->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_productlist.createAutoSuggest({"id":"x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact","forceSelect":true});
</script>
<?php echo $tbl_product->ID_Contact->Lookup->getParamTag("p_x" . $tbl_product_list->RowIndex . "_ID_Contact") ?>
</span>
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_ID_Contact" class="tbl_product_ID_Contact">
<span<?php echo $tbl_product->ID_Contact->viewAttributes() ?>>
<?php echo $tbl_product->ID_Contact->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_product->Description->Visible) { // Description ?>
		<td data-name="Description"<?php echo $tbl_product->Description->cellAttributes() ?>>
<?php if ($tbl_product->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Description" class="form-group tbl_product_Description">
<input type="text" data-table="tbl_product" data-field="x_Description" name="x<?php echo $tbl_product_list->RowIndex ?>_Description" id="x<?php echo $tbl_product_list->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Description->EditValue ?>"<?php echo $tbl_product->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Description" name="o<?php echo $tbl_product_list->RowIndex ?>_Description" id="o<?php echo $tbl_product_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_product->Description->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Description" class="form-group tbl_product_Description">
<input type="text" data-table="tbl_product" data-field="x_Description" name="x<?php echo $tbl_product_list->RowIndex ?>_Description" id="x<?php echo $tbl_product_list->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Description->EditValue ?>"<?php echo $tbl_product->Description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_Description" class="tbl_product_Description">
<span<?php echo $tbl_product->Description->viewAttributes() ?>>
<?php echo $tbl_product->Description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_product->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_product->CreateDate->cellAttributes() ?>>
<?php if ($tbl_product->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_CreateDate" class="form-group tbl_product_CreateDate">
<input type="text" data-table="tbl_product" data-field="x_CreateDate" data-format="11" name="x<?php echo $tbl_product_list->RowIndex ?>_CreateDate" id="x<?php echo $tbl_product_list->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_product->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_product->CreateDate->EditValue ?>"<?php echo $tbl_product->CreateDate->editAttributes() ?>>
<?php if (!$tbl_product->CreateDate->ReadOnly && !$tbl_product->CreateDate->Disabled && !isset($tbl_product->CreateDate->EditAttrs["readonly"]) && !isset($tbl_product->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_productlist", "x<?php echo $tbl_product_list->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_CreateDate" name="o<?php echo $tbl_product_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_product_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_product->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_CreateDate" class="form-group tbl_product_CreateDate">
<span<?php echo $tbl_product->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_product->CreateDate->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_CreateDate" name="x<?php echo $tbl_product_list->RowIndex ?>_CreateDate" id="x<?php echo $tbl_product_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_product->CreateDate->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_CreateDate" class="tbl_product_CreateDate">
<span<?php echo $tbl_product->CreateDate->viewAttributes() ?>>
<?php echo $tbl_product->CreateDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_product->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_product->CreateUser->cellAttributes() ?>>
<?php if ($tbl_product->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_CreateUser" class="form-group tbl_product_CreateUser">
<input type="text" data-table="tbl_product" data-field="x_CreateUser" name="x<?php echo $tbl_product_list->RowIndex ?>_CreateUser" id="x<?php echo $tbl_product_list->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_product->CreateUser->EditValue ?>"<?php echo $tbl_product->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_CreateUser" name="o<?php echo $tbl_product_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_product_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_product->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_CreateUser" class="form-group tbl_product_CreateUser">
<span<?php echo $tbl_product->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_product->CreateUser->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_CreateUser" name="x<?php echo $tbl_product_list->RowIndex ?>_CreateUser" id="x<?php echo $tbl_product_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_product->CreateUser->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_product->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_CreateUser" class="tbl_product_CreateUser">
<span<?php echo $tbl_product->CreateUser->viewAttributes() ?>>
<?php echo $tbl_product->CreateUser->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_product_list->ListOptions->render("body", "right", $tbl_product_list->RowCnt);
?>
	</tr>
<?php if ($tbl_product->RowType == ROWTYPE_ADD || $tbl_product->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_productlist.updateLists(<?php echo $tbl_product_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_product->isGridAdd())
		if (!$tbl_product_list->Recordset->EOF)
			$tbl_product_list->Recordset->moveNext();
}
?>
<?php
	if ($tbl_product->isGridAdd() || $tbl_product->isGridEdit()) {
		$tbl_product_list->RowIndex = '$rowindex$';
		$tbl_product_list->loadRowValues();

		// Set row properties
		$tbl_product->resetAttributes();
		$tbl_product->RowAttrs = array_merge($tbl_product->RowAttrs, array('data-rowindex'=>$tbl_product_list->RowIndex, 'id'=>'r0_tbl_product', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_product->RowAttrs["class"], "ew-template");
		$tbl_product->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_product_list->renderRow();

		// Render list options
		$tbl_product_list->renderListOptions();
		$tbl_product_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_product->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_product_list->ListOptions->render("body", "left", $tbl_product_list->RowIndex);
?>
	<?php if ($tbl_product->IdType->Visible) { // IdType ?>
		<td data-name="IdType">
<span id="el$rowindex$_tbl_product_IdType" class="form-group tbl_product_IdType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product" data-field="x_IdType" data-value-separator="<?php echo $tbl_product->IdType->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_product_list->RowIndex ?>_IdType" name="x<?php echo $tbl_product_list->RowIndex ?>_IdType"<?php echo $tbl_product->IdType->editAttributes() ?>>
		<?php echo $tbl_product->IdType->selectOptionListHtml("x<?php echo $tbl_product_list->RowIndex ?>_IdType") ?>
	</select>
<?php if (AllowAdd(CurrentProjectID() . "tbl_producttype") && !$tbl_product->IdType->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $tbl_product_list->RowIndex ?>_IdType" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $tbl_product->IdType->caption() ?>" data-title="<?php echo $tbl_product->IdType->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $tbl_product_list->RowIndex ?>_IdType',url:'tbl_producttypeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
</div>
<?php echo $tbl_product->IdType->Lookup->getParamTag("p_x" . $tbl_product_list->RowIndex . "_IdType") ?>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_IdType" name="o<?php echo $tbl_product_list->RowIndex ?>_IdType" id="o<?php echo $tbl_product_list->RowIndex ?>_IdType" value="<?php echo HtmlEncode($tbl_product->IdType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->Code->Visible) { // Code ?>
		<td data-name="Code">
<span id="el$rowindex$_tbl_product_Code" class="form-group tbl_product_Code">
<input type="text" data-table="tbl_product" data-field="x_Code" name="x<?php echo $tbl_product_list->RowIndex ?>_Code" id="x<?php echo $tbl_product_list->RowIndex ?>_Code" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Code->EditValue ?>"<?php echo $tbl_product->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Code" name="o<?php echo $tbl_product_list->RowIndex ?>_Code" id="o<?php echo $tbl_product_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_product->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->Model->Visible) { // Model ?>
		<td data-name="Model">
<span id="el$rowindex$_tbl_product_Model" class="form-group tbl_product_Model">
<input type="text" data-table="tbl_product" data-field="x_Model" name="x<?php echo $tbl_product_list->RowIndex ?>_Model" id="x<?php echo $tbl_product_list->RowIndex ?>_Model" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->Model->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Model->EditValue ?>"<?php echo $tbl_product->Model->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Model" name="o<?php echo $tbl_product_list->RowIndex ?>_Model" id="o<?php echo $tbl_product_list->RowIndex ?>_Model" value="<?php echo HtmlEncode($tbl_product->Model->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName">
<span id="el$rowindex$_tbl_product_ProductName" class="form-group tbl_product_ProductName">
<input type="text" data-table="tbl_product" data-field="x_ProductName" name="x<?php echo $tbl_product_list->RowIndex ?>_ProductName" id="x<?php echo $tbl_product_list->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->ProductName->EditValue ?>"<?php echo $tbl_product->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ProductName" name="o<?php echo $tbl_product_list->RowIndex ?>_ProductName" id="o<?php echo $tbl_product_list->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_product->ProductName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->VnName->Visible) { // VnName ?>
		<td data-name="VnName">
<span id="el$rowindex$_tbl_product_VnName" class="form-group tbl_product_VnName">
<input type="text" data-table="tbl_product" data-field="x_VnName" name="x<?php echo $tbl_product_list->RowIndex ?>_VnName" id="x<?php echo $tbl_product_list->RowIndex ?>_VnName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->VnName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->VnName->EditValue ?>"<?php echo $tbl_product->VnName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_VnName" name="o<?php echo $tbl_product_list->RowIndex ?>_VnName" id="o<?php echo $tbl_product_list->RowIndex ?>_VnName" value="<?php echo HtmlEncode($tbl_product->VnName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->ID_Contact->Visible) { // ID_Contact ?>
		<td data-name="ID_Contact">
<span id="el$rowindex$_tbl_product_ID_Contact" class="form-group tbl_product_ID_Contact">
<?php
$wrkonchange = "" . trim(@$tbl_product->ID_Contact->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_product->ID_Contact->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_product_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="sv_x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo RemoveHtml($tbl_product->ID_Contact->EditValue) ?>" size="20" placeholder="<?php echo HtmlEncode($tbl_product->ID_Contact->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_product->ID_Contact->getPlaceHolder()) ?>"<?php echo $tbl_product->ID_Contact->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ID_Contact" data-value-separator="<?php echo $tbl_product->ID_Contact->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo HtmlEncode($tbl_product->ID_Contact->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_productlist.createAutoSuggest({"id":"x<?php echo $tbl_product_list->RowIndex ?>_ID_Contact","forceSelect":true});
</script>
<?php echo $tbl_product->ID_Contact->Lookup->getParamTag("p_x" . $tbl_product_list->RowIndex . "_ID_Contact") ?>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ID_Contact" name="o<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" id="o<?php echo $tbl_product_list->RowIndex ?>_ID_Contact" value="<?php echo HtmlEncode($tbl_product->ID_Contact->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->Description->Visible) { // Description ?>
		<td data-name="Description">
<span id="el$rowindex$_tbl_product_Description" class="form-group tbl_product_Description">
<input type="text" data-table="tbl_product" data-field="x_Description" name="x<?php echo $tbl_product_list->RowIndex ?>_Description" id="x<?php echo $tbl_product_list->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Description->EditValue ?>"<?php echo $tbl_product->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Description" name="o<?php echo $tbl_product_list->RowIndex ?>_Description" id="o<?php echo $tbl_product_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_product->Description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<span id="el$rowindex$_tbl_product_CreateDate" class="form-group tbl_product_CreateDate">
<input type="text" data-table="tbl_product" data-field="x_CreateDate" data-format="11" name="x<?php echo $tbl_product_list->RowIndex ?>_CreateDate" id="x<?php echo $tbl_product_list->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_product->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_product->CreateDate->EditValue ?>"<?php echo $tbl_product->CreateDate->editAttributes() ?>>
<?php if (!$tbl_product->CreateDate->ReadOnly && !$tbl_product->CreateDate->Disabled && !isset($tbl_product->CreateDate->EditAttrs["readonly"]) && !isset($tbl_product->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_productlist", "x<?php echo $tbl_product_list->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_CreateDate" name="o<?php echo $tbl_product_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_product_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_product->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<span id="el$rowindex$_tbl_product_CreateUser" class="form-group tbl_product_CreateUser">
<input type="text" data-table="tbl_product" data-field="x_CreateUser" name="x<?php echo $tbl_product_list->RowIndex ?>_CreateUser" id="x<?php echo $tbl_product_list->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_product->CreateUser->EditValue ?>"<?php echo $tbl_product->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_CreateUser" name="o<?php echo $tbl_product_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_product_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_product->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_product_list->ListOptions->render("body", "right", $tbl_product_list->RowIndex);
?>
<script>
ftbl_productlist.updateLists(<?php echo $tbl_product_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_product->isAdd() || $tbl_product->isCopy()) { ?>
<input type="hidden" name="<?php echo $tbl_product_list->FormKeyCountName ?>" id="<?php echo $tbl_product_list->FormKeyCountName ?>" value="<?php echo $tbl_product_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_product->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $tbl_product_list->FormKeyCountName ?>" id="<?php echo $tbl_product_list->FormKeyCountName ?>" value="<?php echo $tbl_product_list->KeyCount ?>">
<?php echo $tbl_product_list->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_product->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_product_list->FormKeyCountName ?>" id="<?php echo $tbl_product_list->FormKeyCountName ?>" value="<?php echo $tbl_product_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_product->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $tbl_product_list->FormKeyCountName ?>" id="<?php echo $tbl_product_list->FormKeyCountName ?>" value="<?php echo $tbl_product_list->KeyCount ?>">
<?php echo $tbl_product_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$tbl_product->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_product_list->Recordset)
	$tbl_product_list->Recordset->Close();
?>
<?php if (!$tbl_product->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_product->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_product_list->Pager)) $tbl_product_list->Pager = new PrevNextPager($tbl_product_list->StartRec, $tbl_product_list->DisplayRecs, $tbl_product_list->TotalRecs, $tbl_product_list->AutoHidePager) ?>
<?php if ($tbl_product_list->Pager->RecordCount > 0 && $tbl_product_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_product_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_product_list->pageUrl() ?>start=<?php echo $tbl_product_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_product_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_product_list->pageUrl() ?>start=<?php echo $tbl_product_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_product_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_product_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_product_list->pageUrl() ?>start=<?php echo $tbl_product_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_product_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_product_list->pageUrl() ?>start=<?php echo $tbl_product_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_product_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_product_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_product_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_product_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_product_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_product_list->TotalRecs > 0 && (!$tbl_product_list->AutoHidePageSizeSelector || $tbl_product_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_product">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_product_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_product_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_product_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_product_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_product_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_product->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_product_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_product_list->TotalRecs == 0 && !$tbl_product->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_product_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_product_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_product->isExport()) { ?>
<script>
$("[hienThi='tooltip']").tooltip();
// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php if (!$tbl_product->isExport()) { ?>
<script>
ew.scrollableTable("gmp_tbl_product", "90%", "450px");
</script>
<?php } ?>
<?php } ?>
<form method="post" action="uploadProduct.php" enctype="multipart/form-data">
<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import product item list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Excel file <input type="file" accept=".xlsx" name="fileToUpload" id="fileToUpload" value="Choose file">
        <input name="userName" type="hidden" value="<?php echo CurrentUserName()?>">
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="submit" id="idsubmit" type="submit" class="btn btn-primary">Import</button>
      </div>
    </div>
  </div>
</div>
</form>
<?php include_once "footer.php" ?>
<?php
$tbl_product_list->terminate();
?>
