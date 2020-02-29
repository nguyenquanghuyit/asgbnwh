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
$packing_list = new packing_list();

// Run the page
$packing_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$packing_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$packing->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fpackinglist = currentForm = new ew.Form("fpackinglist", "list");
fpackinglist.formKeyCountName = '<?php echo $packing_list->FormKeyCountName ?>';

// Form_CustomValidate event
fpackinglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpackinglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpackinglist.lists["x_TypeName"] = <?php echo $packing_list->TypeName->Lookup->toClientList() ?>;
fpackinglist.lists["x_TypeName"].options = <?php echo JsonEncode($packing_list->TypeName->lookupOptions()) ?>;

// Form object for search
var fpackinglistsrch = currentSearchForm = new ew.Form("fpackinglistsrch");

// Validate function for search
fpackinglistsrch.validate = function(fobj) {
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
fpackinglistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpackinglistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpackinglistsrch.lists["x_TypeName"] = <?php echo $packing_list->TypeName->Lookup->toClientList() ?>;
fpackinglistsrch.lists["x_TypeName"].options = <?php echo JsonEncode($packing_list->TypeName->lookupOptions()) ?>;

// Filters
fpackinglistsrch.filterList = <?php echo $packing_list->getFilterList() ?>;
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
<?php if (!$packing->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($packing_list->TotalRecs > 0 && $packing_list->ExportOptions->visible()) { ?>
<?php $packing_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($packing_list->ImportOptions->visible()) { ?>
<?php $packing_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($packing_list->SearchOptions->visible()) { ?>
<?php $packing_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($packing_list->FilterOptions->visible()) { ?>
<?php $packing_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$packing_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$packing->isExport() && !$packing->CurrentAction) { ?>
<form name="fpackinglistsrch" id="fpackinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($packing_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fpackinglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="packing">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$packing_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$packing->RowType = ROWTYPE_SEARCH;

// Render row
$packing->resetAttributes();
$packing_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($packing->TypeName->Visible) { // TypeName ?>
	<div id="xsc_TypeName" class="ew-cell form-group">
		<label for="x_TypeName" class="ew-search-caption ew-label"><?php echo $packing->TypeName->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="packing" data-field="x_TypeName" data-value-separator="<?php echo $packing->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $packing->TypeName->editAttributes() ?>>
		<?php echo $packing->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $packing->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($packing_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($packing_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $packing_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($packing_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($packing_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($packing_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($packing_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $packing_list->showPageHeader(); ?>
<?php
$packing_list->showMessage();
?>
<?php if ($packing_list->TotalRecs > 0 || $packing->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($packing_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> packing">
<?php if (!$packing->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$packing->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($packing_list->Pager)) $packing_list->Pager = new PrevNextPager($packing_list->StartRec, $packing_list->DisplayRecs, $packing_list->TotalRecs, $packing_list->AutoHidePager) ?>
<?php if ($packing_list->Pager->RecordCount > 0 && $packing_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($packing_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $packing_list->pageUrl() ?>start=<?php echo $packing_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($packing_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $packing_list->pageUrl() ?>start=<?php echo $packing_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $packing_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($packing_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $packing_list->pageUrl() ?>start=<?php echo $packing_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($packing_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $packing_list->pageUrl() ?>start=<?php echo $packing_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $packing_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($packing_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $packing_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $packing_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $packing_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($packing_list->TotalRecs > 0 && (!$packing_list->AutoHidePageSizeSelector || $packing_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="packing">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($packing_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($packing_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($packing_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($packing_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($packing_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($packing->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $packing_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpackinglist" id="fpackinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($packing_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $packing_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="packing">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_packing" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($packing_list->TotalRecs > 0 || $packing->isGridEdit()) { ?>
<table id="tbl_packinglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$packing_list->RowType = ROWTYPE_HEADER;

// Render list options
$packing_list->renderListOptions();

// Render list options (header, left)
$packing_list->ListOptions->render("header", "left");
?>
<?php if ($packing->ID_Order->Visible) { // ID_Order ?>
	<?php if ($packing->sortUrl($packing->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $packing->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_packing_ID_Order" class="packing_ID_Order"><div class="ew-table-header-caption"><?php echo $packing->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $packing->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $packing->SortUrl($packing->ID_Order) ?>',2);"><div id="elh_packing_ID_Order" class="packing_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packing->ID_Order->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($packing->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($packing->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packing->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
	<?php if ($packing->sortUrl($packing->CusomterOrderNo) == "") { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $packing->CusomterOrderNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_packing_CusomterOrderNo" class="packing_CusomterOrderNo"><div class="ew-table-header-caption"><?php echo $packing->CusomterOrderNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $packing->CusomterOrderNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $packing->SortUrl($packing->CusomterOrderNo) ?>',2);"><div id="elh_packing_CusomterOrderNo" class="packing_CusomterOrderNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packing->CusomterOrderNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($packing->CusomterOrderNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($packing->CusomterOrderNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packing->TypeName->Visible) { // TypeName ?>
	<?php if ($packing->sortUrl($packing->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $packing->TypeName->headerCellClass() ?>"><div id="elh_packing_TypeName" class="packing_TypeName"><div class="ew-table-header-caption"><?php echo $packing->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $packing->TypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $packing->SortUrl($packing->TypeName) ?>',2);"><div id="elh_packing_TypeName" class="packing_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packing->TypeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($packing->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($packing->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packing->CreateUser->Visible) { // CreateUser ?>
	<?php if ($packing->sortUrl($packing->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $packing->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_packing_CreateUser" class="packing_CreateUser"><div class="ew-table-header-caption"><?php echo $packing->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $packing->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $packing->SortUrl($packing->CreateUser) ?>',2);"><div id="elh_packing_CreateUser" class="packing_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packing->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($packing->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($packing->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packing->CreateDate->Visible) { // CreateDate ?>
	<?php if ($packing->sortUrl($packing->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $packing->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_packing_CreateDate" class="packing_CreateDate"><div class="ew-table-header-caption"><?php echo $packing->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $packing->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $packing->SortUrl($packing->CreateDate) ?>',2);"><div id="elh_packing_CreateDate" class="packing_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packing->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($packing->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($packing->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$packing_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($packing->ExportAll && $packing->isExport()) {
	$packing_list->StopRec = $packing_list->TotalRecs;
} else {

	// Set the last record to display
	if ($packing_list->TotalRecs > $packing_list->StartRec + $packing_list->DisplayRecs - 1)
		$packing_list->StopRec = $packing_list->StartRec + $packing_list->DisplayRecs - 1;
	else
		$packing_list->StopRec = $packing_list->TotalRecs;
}
$packing_list->RecCnt = $packing_list->StartRec - 1;
if ($packing_list->Recordset && !$packing_list->Recordset->EOF) {
	$packing_list->Recordset->moveFirst();
	$selectLimit = $packing_list->UseSelectLimit;
	if (!$selectLimit && $packing_list->StartRec > 1)
		$packing_list->Recordset->move($packing_list->StartRec - 1);
} elseif (!$packing->AllowAddDeleteRow && $packing_list->StopRec == 0) {
	$packing_list->StopRec = $packing->GridAddRowCount;
}

// Initialize aggregate
$packing->RowType = ROWTYPE_AGGREGATEINIT;
$packing->resetAttributes();
$packing_list->renderRow();
while ($packing_list->RecCnt < $packing_list->StopRec) {
	$packing_list->RecCnt++;
	if ($packing_list->RecCnt >= $packing_list->StartRec) {
		$packing_list->RowCnt++;

		// Set up key count
		$packing_list->KeyCount = $packing_list->RowIndex;

		// Init row class and style
		$packing->resetAttributes();
		$packing->CssClass = "";
		if ($packing->isGridAdd()) {
		} else {
			$packing_list->loadRowValues($packing_list->Recordset); // Load row values
		}
		$packing->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$packing->RowAttrs = array_merge($packing->RowAttrs, array('data-rowindex'=>$packing_list->RowCnt, 'id'=>'r' . $packing_list->RowCnt . '_packing', 'data-rowtype'=>$packing->RowType));

		// Render row
		$packing_list->renderRow();

		// Render list options
		$packing_list->renderListOptions();
?>
	<tr<?php echo $packing->rowAttributes() ?>>
<?php

// Render list options (body, left)
$packing_list->ListOptions->render("body", "left", $packing_list->RowCnt);
?>
	<?php if ($packing->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $packing->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $packing_list->RowCnt ?>_packing_ID_Order" class="packing_ID_Order">
<span<?php echo $packing->ID_Order->viewAttributes() ?>>
<?php echo $packing->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packing->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td data-name="CusomterOrderNo"<?php echo $packing->CusomterOrderNo->cellAttributes() ?>>
<span id="el<?php echo $packing_list->RowCnt ?>_packing_CusomterOrderNo" class="packing_CusomterOrderNo">
<span<?php echo $packing->CusomterOrderNo->viewAttributes() ?>>
<?php echo $packing->CusomterOrderNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packing->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $packing->TypeName->cellAttributes() ?>>
<span id="el<?php echo $packing_list->RowCnt ?>_packing_TypeName" class="packing_TypeName">
<span<?php echo $packing->TypeName->viewAttributes() ?>>
<?php echo $packing->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packing->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $packing->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $packing_list->RowCnt ?>_packing_CreateUser" class="packing_CreateUser">
<span<?php echo $packing->CreateUser->viewAttributes() ?>>
<?php echo $packing->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packing->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $packing->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $packing_list->RowCnt ?>_packing_CreateDate" class="packing_CreateDate">
<span<?php echo $packing->CreateDate->viewAttributes() ?>>
<?php echo $packing->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$packing_list->ListOptions->render("body", "right", $packing_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$packing->isGridAdd())
		$packing_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$packing->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($packing_list->Recordset)
	$packing_list->Recordset->Close();
?>
<?php if (!$packing->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$packing->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($packing_list->Pager)) $packing_list->Pager = new PrevNextPager($packing_list->StartRec, $packing_list->DisplayRecs, $packing_list->TotalRecs, $packing_list->AutoHidePager) ?>
<?php if ($packing_list->Pager->RecordCount > 0 && $packing_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($packing_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $packing_list->pageUrl() ?>start=<?php echo $packing_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($packing_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $packing_list->pageUrl() ?>start=<?php echo $packing_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $packing_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($packing_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $packing_list->pageUrl() ?>start=<?php echo $packing_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($packing_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $packing_list->pageUrl() ?>start=<?php echo $packing_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $packing_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($packing_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $packing_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $packing_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $packing_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($packing_list->TotalRecs > 0 && (!$packing_list->AutoHidePageSizeSelector || $packing_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="packing">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($packing_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($packing_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($packing_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($packing_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($packing_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($packing->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $packing_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($packing_list->TotalRecs == 0 && !$packing->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $packing_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$packing_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$packing->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$packing_list->terminate();
?>