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
$tbl_order_list = new tbl_order_list();

// Run the page
$tbl_order_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_order_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_order->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_orderlist = currentForm = new ew.Form("ftbl_orderlist", "list");
ftbl_orderlist.formKeyCountName = '<?php echo $tbl_order_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_orderlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderlist.lists["x_IdType"] = <?php echo $tbl_order_list->IdType->Lookup->toClientList() ?>;
ftbl_orderlist.lists["x_IdType"].options = <?php echo JsonEncode($tbl_order_list->IdType->lookupOptions()) ?>;
ftbl_orderlist.lists["x_ID_Contact"] = <?php echo $tbl_order_list->ID_Contact->Lookup->toClientList() ?>;
ftbl_orderlist.lists["x_ID_Contact"].options = <?php echo JsonEncode($tbl_order_list->ID_Contact->lookupOptions()) ?>;
ftbl_orderlist.autoSuggests["x_ID_Contact"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftbl_orderlist.lists["x_StatusLoad"] = <?php echo $tbl_order_list->StatusLoad->Lookup->toClientList() ?>;
ftbl_orderlist.lists["x_StatusLoad"].options = <?php echo JsonEncode($tbl_order_list->StatusLoad->options(FALSE, TRUE)) ?>;
ftbl_orderlist.lists["x_StatusFinishOrder"] = <?php echo $tbl_order_list->StatusFinishOrder->Lookup->toClientList() ?>;
ftbl_orderlist.lists["x_StatusFinishOrder"].options = <?php echo JsonEncode($tbl_order_list->StatusFinishOrder->options(FALSE, TRUE)) ?>;

// Form object for search
var ftbl_orderlistsrch = currentSearchForm = new ew.Form("ftbl_orderlistsrch");

// Validate function for search
ftbl_orderlistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_OrderDate");
	if (elm && !ew.checkEuroDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($tbl_order->OrderDate->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ftbl_orderlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderlistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderlistsrch.lists["x_IdType"] = <?php echo $tbl_order_list->IdType->Lookup->toClientList() ?>;
ftbl_orderlistsrch.lists["x_IdType"].options = <?php echo JsonEncode($tbl_order_list->IdType->lookupOptions()) ?>;
ftbl_orderlistsrch.lists["x_StatusLoad"] = <?php echo $tbl_order_list->StatusLoad->Lookup->toClientList() ?>;
ftbl_orderlistsrch.lists["x_StatusLoad"].options = <?php echo JsonEncode($tbl_order_list->StatusLoad->options(FALSE, TRUE)) ?>;
ftbl_orderlistsrch.lists["x_StatusFinishOrder"] = <?php echo $tbl_order_list->StatusFinishOrder->Lookup->toClientList() ?>;
ftbl_orderlistsrch.lists["x_StatusFinishOrder"].options = <?php echo JsonEncode($tbl_order_list->StatusFinishOrder->options(FALSE, TRUE)) ?>;

// Filters
ftbl_orderlistsrch.filterList = <?php echo $tbl_order_list->getFilterList() ?>;
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
<?php if (!$tbl_order->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_order_list->TotalRecs > 0 && $tbl_order_list->ExportOptions->visible()) { ?>
<?php $tbl_order_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_order_list->ImportOptions->visible()) { ?>
<?php $tbl_order_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_order_list->SearchOptions->visible()) { ?>
<?php $tbl_order_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_order_list->FilterOptions->visible()) { ?>
<?php $tbl_order_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_order_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_order->isExport() && !$tbl_order->CurrentAction) { ?>
<form name="ftbl_orderlistsrch" id="ftbl_orderlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_order_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_orderlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_order">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$tbl_order_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_order->RowType = ROWTYPE_SEARCH;

// Render row
$tbl_order->resetAttributes();
$tbl_order_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($tbl_order->OrderDate->Visible) { // OrderDate ?>
	<div id="xsc_OrderDate" class="ew-cell form-group">
		<label for="x_OrderDate" class="ew-search-caption ew-label"><?php echo $tbl_order->OrderDate->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_OrderDate" id="z_OrderDate" value="BETWEEN"></span>
		<span class="ew-search-field">
<input type="text" data-table="tbl_order" data-field="x_OrderDate" data-format="7" name="x_OrderDate" id="x_OrderDate" placeholder="<?php echo HtmlEncode($tbl_order->OrderDate->getPlaceHolder()) ?>" value="<?php echo $tbl_order->OrderDate->EditValue ?>"<?php echo $tbl_order->OrderDate->editAttributes() ?>>
<?php if (!$tbl_order->OrderDate->ReadOnly && !$tbl_order->OrderDate->Disabled && !isset($tbl_order->OrderDate->EditAttrs["readonly"]) && !isset($tbl_order->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_orderlistsrch", "x_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw1_OrderDate"><label><?php echo $Language->Phrase("AND") ?></label></span>
		<span class="ew-search-field btw1_OrderDate">
<input type="text" data-table="tbl_order" data-field="x_OrderDate" data-format="7" name="y_OrderDate" id="y_OrderDate" placeholder="<?php echo HtmlEncode($tbl_order->OrderDate->getPlaceHolder()) ?>" value="<?php echo $tbl_order->OrderDate->EditValue2 ?>"<?php echo $tbl_order->OrderDate->editAttributes() ?>>
<?php if (!$tbl_order->OrderDate->ReadOnly && !$tbl_order->OrderDate->Disabled && !isset($tbl_order->OrderDate->EditAttrs["readonly"]) && !isset($tbl_order->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_orderlistsrch", "y_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($tbl_order->IdType->Visible) { // IdType ?>
	<div id="xsc_IdType" class="ew-cell form-group">
		<label for="x_IdType" class="ew-search-caption ew-label"><?php echo $tbl_order->IdType->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_IdType" id="z_IdType" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_order" data-field="x_IdType" data-value-separator="<?php echo $tbl_order->IdType->displayValueSeparatorAttribute() ?>" id="x_IdType" name="x_IdType"<?php echo $tbl_order->IdType->editAttributes() ?>>
		<?php echo $tbl_order->IdType->selectOptionListHtml("x_IdType") ?>
	</select>
</div>
<?php echo $tbl_order->IdType->Lookup->getParamTag("p_x_IdType") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
<?php if ($tbl_order->StatusLoad->Visible) { // StatusLoad ?>
	<div id="xsc_StatusLoad" class="ew-cell form-group">
		<label for="x_StatusLoad" class="ew-search-caption ew-label"><?php echo $tbl_order->StatusLoad->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_StatusLoad" id="z_StatusLoad" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_order" data-field="x_StatusLoad" data-value-separator="<?php echo $tbl_order->StatusLoad->displayValueSeparatorAttribute() ?>" id="x_StatusLoad" name="x_StatusLoad"<?php echo $tbl_order->StatusLoad->editAttributes() ?>>
		<?php echo $tbl_order->StatusLoad->selectOptionListHtml("x_StatusLoad") ?>
	</select>
</div>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ew-row d-sm-flex">
<?php if ($tbl_order->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
	<div id="xsc_StatusFinishOrder" class="ew-cell form-group">
		<label for="x_StatusFinishOrder" class="ew-search-caption ew-label"><?php echo $tbl_order->StatusFinishOrder->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_StatusFinishOrder" id="z_StatusFinishOrder" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_order" data-field="x_StatusFinishOrder" data-value-separator="<?php echo $tbl_order->StatusFinishOrder->displayValueSeparatorAttribute() ?>" id="x_StatusFinishOrder" name="x_StatusFinishOrder"<?php echo $tbl_order->StatusFinishOrder->editAttributes() ?>>
		<?php echo $tbl_order->StatusFinishOrder->selectOptionListHtml("x_StatusFinishOrder") ?>
	</select>
</div>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_5" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_order_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_order_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_order_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_order_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_order_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_order_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_order_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_order_list->showPageHeader(); ?>
<?php
$tbl_order_list->showMessage();
?>
<?php if ($tbl_order_list->TotalRecs > 0 || $tbl_order->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_order_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_order">
<?php if (!$tbl_order->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_order->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_order_list->Pager)) $tbl_order_list->Pager = new PrevNextPager($tbl_order_list->StartRec, $tbl_order_list->DisplayRecs, $tbl_order_list->TotalRecs, $tbl_order_list->AutoHidePager) ?>
<?php if ($tbl_order_list->Pager->RecordCount > 0 && $tbl_order_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_order_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_order_list->pageUrl() ?>start=<?php echo $tbl_order_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_order_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_order_list->pageUrl() ?>start=<?php echo $tbl_order_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_order_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_order_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_order_list->pageUrl() ?>start=<?php echo $tbl_order_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_order_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_order_list->pageUrl() ?>start=<?php echo $tbl_order_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_order_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_order_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_order_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_order_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_order_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_order_list->TotalRecs > 0 && (!$tbl_order_list->AutoHidePageSizeSelector || $tbl_order_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_order">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_order_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_order_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_order_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_order_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_order_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_order->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_order_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_orderlist" id="ftbl_orderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_order_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_order_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_order">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_order" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_order_list->TotalRecs > 0 || $tbl_order->isGridEdit()) { ?>
<table id="tbl_tbl_orderlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_order_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_order_list->renderListOptions();

// Render list options (header, left)
$tbl_order_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_order->ID_Order->Visible) { // ID_Order ?>
	<?php if ($tbl_order->sortUrl($tbl_order->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $tbl_order->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_ID_Order" class="tbl_order_ID_Order"><div class="ew-table-header-caption"><?php echo $tbl_order->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $tbl_order->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order->SortUrl($tbl_order->ID_Order) ?>',2);"><div id="elh_tbl_order_ID_Order" class="tbl_order_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order->ID_Order->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order->OrderDate->Visible) { // OrderDate ?>
	<?php if ($tbl_order->sortUrl($tbl_order->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $tbl_order->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_OrderDate" class="tbl_order_OrderDate"><div class="ew-table-header-caption"><?php echo $tbl_order->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $tbl_order->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order->SortUrl($tbl_order->OrderDate) ?>',2);"><div id="elh_tbl_order_OrderDate" class="tbl_order_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order->OrderDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order->OrderDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order->InvoiceNo->Visible) { // InvoiceNo ?>
	<?php if ($tbl_order->sortUrl($tbl_order->InvoiceNo) == "") { ?>
		<th data-name="InvoiceNo" class="<?php echo $tbl_order->InvoiceNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_InvoiceNo" class="tbl_order_InvoiceNo"><div class="ew-table-header-caption"><?php echo $tbl_order->InvoiceNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InvoiceNo" class="<?php echo $tbl_order->InvoiceNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order->SortUrl($tbl_order->InvoiceNo) ?>',2);"><div id="elh_tbl_order_InvoiceNo" class="tbl_order_InvoiceNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order->InvoiceNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order->InvoiceNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order->InvoiceNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
	<?php if ($tbl_order->sortUrl($tbl_order->CusomterOrderNo) == "") { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $tbl_order->CusomterOrderNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_CusomterOrderNo" class="tbl_order_CusomterOrderNo"><div class="ew-table-header-caption"><?php echo $tbl_order->CusomterOrderNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $tbl_order->CusomterOrderNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order->SortUrl($tbl_order->CusomterOrderNo) ?>',2);"><div id="elh_tbl_order_CusomterOrderNo" class="tbl_order_CusomterOrderNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order->CusomterOrderNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order->CusomterOrderNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order->CusomterOrderNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order->IdType->Visible) { // IdType ?>
	<?php if ($tbl_order->sortUrl($tbl_order->IdType) == "") { ?>
		<th data-name="IdType" class="<?php echo $tbl_order->IdType->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_IdType" class="tbl_order_IdType"><div class="ew-table-header-caption"><?php echo $tbl_order->IdType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IdType" class="<?php echo $tbl_order->IdType->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order->SortUrl($tbl_order->IdType) ?>',2);"><div id="elh_tbl_order_IdType" class="tbl_order_IdType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order->IdType->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order->IdType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order->IdType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order->ID_Contact->Visible) { // ID_Contact ?>
	<?php if ($tbl_order->sortUrl($tbl_order->ID_Contact) == "") { ?>
		<th data-name="ID_Contact" class="<?php echo $tbl_order->ID_Contact->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_ID_Contact" class="tbl_order_ID_Contact"><div class="ew-table-header-caption"><?php echo $tbl_order->ID_Contact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Contact" class="<?php echo $tbl_order->ID_Contact->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order->SortUrl($tbl_order->ID_Contact) ?>',2);"><div id="elh_tbl_order_ID_Contact" class="tbl_order_ID_Contact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order->ID_Contact->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order->ID_Contact->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order->ID_Contact->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_order->sortUrl($tbl_order->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_order->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_CreateUser" class="tbl_order_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_order->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_order->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order->SortUrl($tbl_order->CreateUser) ?>',2);"><div id="elh_tbl_order_CreateUser" class="tbl_order_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_order->sortUrl($tbl_order->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_order->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_CreateDate" class="tbl_order_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_order->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_order->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order->SortUrl($tbl_order->CreateDate) ?>',2);"><div id="elh_tbl_order_CreateDate" class="tbl_order_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order->StatusLoad->Visible) { // StatusLoad ?>
	<?php if ($tbl_order->sortUrl($tbl_order->StatusLoad) == "") { ?>
		<th data-name="StatusLoad" class="<?php echo $tbl_order->StatusLoad->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_StatusLoad" class="tbl_order_StatusLoad"><div class="ew-table-header-caption"><?php echo $tbl_order->StatusLoad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StatusLoad" class="<?php echo $tbl_order->StatusLoad->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order->SortUrl($tbl_order->StatusLoad) ?>',2);"><div id="elh_tbl_order_StatusLoad" class="tbl_order_StatusLoad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order->StatusLoad->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order->StatusLoad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order->StatusLoad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
	<?php if ($tbl_order->sortUrl($tbl_order->StatusFinishOrder) == "") { ?>
		<th data-name="StatusFinishOrder" class="<?php echo $tbl_order->StatusFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_StatusFinishOrder" class="tbl_order_StatusFinishOrder"><div class="ew-table-header-caption"><?php echo $tbl_order->StatusFinishOrder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StatusFinishOrder" class="<?php echo $tbl_order->StatusFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order->SortUrl($tbl_order->StatusFinishOrder) ?>',2);"><div id="elh_tbl_order_StatusFinishOrder" class="tbl_order_StatusFinishOrder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order->StatusFinishOrder->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order->StatusFinishOrder->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order->StatusFinishOrder->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<th>&nbsp;</th>
<?php

// Render list options (header, right)
$tbl_order_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_order->ExportAll && $tbl_order->isExport()) {
	$tbl_order_list->StopRec = $tbl_order_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_order_list->TotalRecs > $tbl_order_list->StartRec + $tbl_order_list->DisplayRecs - 1)
		$tbl_order_list->StopRec = $tbl_order_list->StartRec + $tbl_order_list->DisplayRecs - 1;
	else
		$tbl_order_list->StopRec = $tbl_order_list->TotalRecs;
}
$tbl_order_list->RecCnt = $tbl_order_list->StartRec - 1;
if ($tbl_order_list->Recordset && !$tbl_order_list->Recordset->EOF) {
	$tbl_order_list->Recordset->moveFirst();
	$selectLimit = $tbl_order_list->UseSelectLimit;
	if (!$selectLimit && $tbl_order_list->StartRec > 1)
		$tbl_order_list->Recordset->move($tbl_order_list->StartRec - 1);
} elseif (!$tbl_order->AllowAddDeleteRow && $tbl_order_list->StopRec == 0) {
	$tbl_order_list->StopRec = $tbl_order->GridAddRowCount;
}

// Initialize aggregate
$tbl_order->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_order->resetAttributes();
$tbl_order_list->renderRow();
while ($tbl_order_list->RecCnt < $tbl_order_list->StopRec) {
	$tbl_order_list->RecCnt++;
	if ($tbl_order_list->RecCnt >= $tbl_order_list->StartRec) {
		$tbl_order_list->RowCnt++;

		// Set up key count
		$tbl_order_list->KeyCount = $tbl_order_list->RowIndex;

		// Init row class and style
		$tbl_order->resetAttributes();
		$tbl_order->CssClass = "";
		if ($tbl_order->isGridAdd()) {
		} else {
			$tbl_order_list->loadRowValues($tbl_order_list->Recordset); // Load row values
		}
		$tbl_order->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_order->RowAttrs = array_merge($tbl_order->RowAttrs, array('data-rowindex'=>$tbl_order_list->RowCnt, 'id'=>'r' . $tbl_order_list->RowCnt . '_tbl_order', 'data-rowtype'=>$tbl_order->RowType));

		// Render row
		$tbl_order_list->renderRow();

		// Render list options
		$tbl_order_list->renderListOptions();
?>
	<tr<?php echo $tbl_order->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_order_list->ListOptions->render("body", "left", $tbl_order_list->RowCnt);
?>
	<?php if ($tbl_order->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $tbl_order->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_list->RowCnt ?>_tbl_order_ID_Order" class="tbl_order_ID_Order">
<span<?php echo $tbl_order->ID_Order->viewAttributes() ?>>
<?php echo $tbl_order->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_order->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate"<?php echo $tbl_order->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_list->RowCnt ?>_tbl_order_OrderDate" class="tbl_order_OrderDate">
<span<?php echo $tbl_order->OrderDate->viewAttributes() ?>>
<?php echo $tbl_order->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_order->InvoiceNo->Visible) { // InvoiceNo ?>
		<td data-name="InvoiceNo"<?php echo $tbl_order->InvoiceNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_list->RowCnt ?>_tbl_order_InvoiceNo" class="tbl_order_InvoiceNo">
<span<?php echo $tbl_order->InvoiceNo->viewAttributes() ?>>
<?php echo $tbl_order->InvoiceNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_order->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td data-name="CusomterOrderNo"<?php echo $tbl_order->CusomterOrderNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_list->RowCnt ?>_tbl_order_CusomterOrderNo" class="tbl_order_CusomterOrderNo">
<span<?php echo $tbl_order->CusomterOrderNo->viewAttributes() ?>>
<?php echo $tbl_order->CusomterOrderNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_order->IdType->Visible) { // IdType ?>
		<td data-name="IdType"<?php echo $tbl_order->IdType->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_list->RowCnt ?>_tbl_order_IdType" class="tbl_order_IdType">
<span<?php echo $tbl_order->IdType->viewAttributes() ?>>
<?php echo $tbl_order->IdType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_order->ID_Contact->Visible) { // ID_Contact ?>
		<td data-name="ID_Contact"<?php echo $tbl_order->ID_Contact->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_list->RowCnt ?>_tbl_order_ID_Contact" class="tbl_order_ID_Contact">
<span<?php echo $tbl_order->ID_Contact->viewAttributes() ?>>
<?php echo $tbl_order->ID_Contact->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_order->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_order->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_list->RowCnt ?>_tbl_order_CreateUser" class="tbl_order_CreateUser">
<span<?php echo $tbl_order->CreateUser->viewAttributes() ?>>
<?php echo $tbl_order->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_order->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_order->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_list->RowCnt ?>_tbl_order_CreateDate" class="tbl_order_CreateDate">
<span<?php echo $tbl_order->CreateDate->viewAttributes() ?>>
<?php echo $tbl_order->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_order->StatusLoad->Visible) { // StatusLoad ?>
		<td data-name="StatusLoad"<?php echo $tbl_order->StatusLoad->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_list->RowCnt ?>_tbl_order_StatusLoad" class="tbl_order_StatusLoad">
<span<?php echo $tbl_order->StatusLoad->viewAttributes() ?>>
<?php echo $tbl_order->StatusLoad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_order->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
		<td data-name="StatusFinishOrder"<?php echo $tbl_order->StatusFinishOrder->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_list->RowCnt ?>_tbl_order_StatusFinishOrder" class="tbl_order_StatusFinishOrder">
<span<?php echo $tbl_order->StatusFinishOrder->viewAttributes() ?>>
<?php echo $tbl_order->StatusFinishOrder->getViewValue() ?></span>
</span>
</td>
</td>
	<?php } ?>
<?php include_once "mycnn.php"?>
<td align="center">
    <?php if($tbl_order->StatusLoad->CurrentValue!=1){?>
    <a class="btn btn-outline-danger" href="InsertGuide.php?orderNo=<?php echo $tbl_order->ID_Order->getViewValue() ?>">Guide pickup</a>
    <?php }
		$rs=mysqli_query($cnn,"SELECT ID_Order FROM vwOrder_Not_Route WHERE ID_Order=".$tbl_order->ID_Order->getViewValue());
		if(mysqli_num_rows($rs)==0){
			?>
			<img src="images/truck.jpg" width="40px" height="30px">
			<?php
		}
	?>
</td>
        
<?php

// Render list options (body, right)
$tbl_order_list->ListOptions->render("body", "right", $tbl_order_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_order->isGridAdd())
		$tbl_order_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_order->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_order_list->Recordset)
	$tbl_order_list->Recordset->Close();
?>
<?php if (!$tbl_order->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_order->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_order_list->Pager)) $tbl_order_list->Pager = new PrevNextPager($tbl_order_list->StartRec, $tbl_order_list->DisplayRecs, $tbl_order_list->TotalRecs, $tbl_order_list->AutoHidePager) ?>
<?php if ($tbl_order_list->Pager->RecordCount > 0 && $tbl_order_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_order_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_order_list->pageUrl() ?>start=<?php echo $tbl_order_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_order_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_order_list->pageUrl() ?>start=<?php echo $tbl_order_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_order_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_order_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_order_list->pageUrl() ?>start=<?php echo $tbl_order_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_order_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_order_list->pageUrl() ?>start=<?php echo $tbl_order_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_order_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_order_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_order_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_order_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_order_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_order_list->TotalRecs > 0 && (!$tbl_order_list->AutoHidePageSizeSelector || $tbl_order_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_order">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_order_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_order_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_order_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_order_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_order_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_order->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_order_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_order_list->TotalRecs == 0 && !$tbl_order->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_order_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_order_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_order->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_order_list->terminate();
?>