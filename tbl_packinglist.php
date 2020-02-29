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
$tbl_packing_list = new tbl_packing_list();

// Run the page
$tbl_packing_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_packing_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_packing->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_packinglist = currentForm = new ew.Form("ftbl_packinglist", "list");
ftbl_packinglist.formKeyCountName = '<?php echo $tbl_packing_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_packinglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_packinglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_packinglist.lists["x_Id_order"] = <?php echo $tbl_packing_list->Id_order->Lookup->toClientList() ?>;
ftbl_packinglist.lists["x_Id_order"].options = <?php echo JsonEncode($tbl_packing_list->Id_order->lookupOptions()) ?>;
ftbl_packinglist.autoSuggests["x_Id_order"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var ftbl_packinglistsrch = currentSearchForm = new ew.Form("ftbl_packinglistsrch");

// Validate function for search
ftbl_packinglistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_Id_order");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($tbl_packing->Id_order->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ftbl_packinglistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_packinglistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_packinglistsrch.lists["x_Id_order"] = <?php echo $tbl_packing_list->Id_order->Lookup->toClientList() ?>;
ftbl_packinglistsrch.lists["x_Id_order"].options = <?php echo JsonEncode($tbl_packing_list->Id_order->lookupOptions()) ?>;
ftbl_packinglistsrch.autoSuggests["x_Id_order"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Filters
ftbl_packinglistsrch.filterList = <?php echo $tbl_packing_list->getFilterList() ?>;
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
<?php if (!$tbl_packing->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_packing_list->TotalRecs > 0 && $tbl_packing_list->ExportOptions->visible()) { ?>
<?php $tbl_packing_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_packing_list->ImportOptions->visible()) { ?>
<?php $tbl_packing_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_packing_list->SearchOptions->visible()) { ?>
<?php $tbl_packing_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_packing_list->FilterOptions->visible()) { ?>
<?php $tbl_packing_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_packing_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_packing->isExport() && !$tbl_packing->CurrentAction) { ?>
<form name="ftbl_packinglistsrch" id="ftbl_packinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_packing_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_packinglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_packing">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$tbl_packing_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_packing->RowType = ROWTYPE_SEARCH;

// Render row
$tbl_packing->resetAttributes();
$tbl_packing_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($tbl_packing->Id_order->Visible) { // Id_order ?>
	<div id="xsc_Id_order" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $tbl_packing->Id_order->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Id_order" id="z_Id_order" value="="></span>
		<span class="ew-search-field">
<?php
$wrkonchange = "" . trim(@$tbl_packing->Id_order->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_packing->Id_order->EditAttrs["onchange"] = "";
?>
<span id="as_x_Id_order" class="text-nowrap" style="z-index: 8980">
	<input type="text" class="form-control" name="sv_x_Id_order" id="sv_x_Id_order" value="<?php echo RemoveHtml($tbl_packing->Id_order->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_packing->Id_order->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_packing->Id_order->getPlaceHolder()) ?>"<?php echo $tbl_packing->Id_order->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_packing" data-field="x_Id_order" data-value-separator="<?php echo $tbl_packing->Id_order->displayValueSeparatorAttribute() ?>" name="x_Id_order" id="x_Id_order" value="<?php echo HtmlEncode($tbl_packing->Id_order->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_packinglistsrch.createAutoSuggest({"id":"x_Id_order","forceSelect":true});
</script>
<?php echo $tbl_packing->Id_order->Lookup->getParamTag("p_x_Id_order") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_packing_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_packing_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_packing_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_packing_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_packing_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_packing_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_packing_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_packing_list->showPageHeader(); ?>
<?php
$tbl_packing_list->showMessage();
?>
<?php if ($tbl_packing_list->TotalRecs > 0 || $tbl_packing->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_packing_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_packing">
<?php if (!$tbl_packing->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_packing->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_packing_list->Pager)) $tbl_packing_list->Pager = new PrevNextPager($tbl_packing_list->StartRec, $tbl_packing_list->DisplayRecs, $tbl_packing_list->TotalRecs, $tbl_packing_list->AutoHidePager) ?>
<?php if ($tbl_packing_list->Pager->RecordCount > 0 && $tbl_packing_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_packing_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_packing_list->pageUrl() ?>start=<?php echo $tbl_packing_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_packing_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_packing_list->pageUrl() ?>start=<?php echo $tbl_packing_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_packing_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_packing_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_packing_list->pageUrl() ?>start=<?php echo $tbl_packing_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_packing_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_packing_list->pageUrl() ?>start=<?php echo $tbl_packing_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_packing_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_packing_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_packing_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_packing_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_packing_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_packing_list->TotalRecs > 0 && (!$tbl_packing_list->AutoHidePageSizeSelector || $tbl_packing_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_packing">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_packing_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_packing_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_packing_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_packing_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_packing_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_packing->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_packing_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_packinglist" id="ftbl_packinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_packing_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_packing_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_packing">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_packing" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_packing_list->TotalRecs > 0 || $tbl_packing->isGridEdit()) { ?>
<table id="tbl_tbl_packinglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_packing_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_packing_list->renderListOptions();

// Render list options (header, left)
$tbl_packing_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_packing->Id_order->Visible) { // Id_order ?>
	<?php if ($tbl_packing->sortUrl($tbl_packing->Id_order) == "") { ?>
		<th data-name="Id_order" class="<?php echo $tbl_packing->Id_order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packing_Id_order" class="tbl_packing_Id_order"><div class="ew-table-header-caption"><?php echo $tbl_packing->Id_order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Id_order" class="<?php echo $tbl_packing->Id_order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packing->SortUrl($tbl_packing->Id_order) ?>',2);"><div id="elh_tbl_packing_Id_order" class="tbl_packing_Id_order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packing->Id_order->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packing->Id_order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packing->Id_order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packing->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_packing->sortUrl($tbl_packing->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_packing->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packing_CreateUser" class="tbl_packing_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_packing->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_packing->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packing->SortUrl($tbl_packing->CreateUser) ?>',2);"><div id="elh_tbl_packing_CreateUser" class="tbl_packing_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packing->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_packing->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packing->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packing->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_packing->sortUrl($tbl_packing->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_packing->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packing_CreateDate" class="tbl_packing_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_packing->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_packing->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packing->SortUrl($tbl_packing->CreateDate) ?>',2);"><div id="elh_tbl_packing_CreateDate" class="tbl_packing_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packing->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packing->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packing->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_packing_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_packing->ExportAll && $tbl_packing->isExport()) {
	$tbl_packing_list->StopRec = $tbl_packing_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_packing_list->TotalRecs > $tbl_packing_list->StartRec + $tbl_packing_list->DisplayRecs - 1)
		$tbl_packing_list->StopRec = $tbl_packing_list->StartRec + $tbl_packing_list->DisplayRecs - 1;
	else
		$tbl_packing_list->StopRec = $tbl_packing_list->TotalRecs;
}
$tbl_packing_list->RecCnt = $tbl_packing_list->StartRec - 1;
if ($tbl_packing_list->Recordset && !$tbl_packing_list->Recordset->EOF) {
	$tbl_packing_list->Recordset->moveFirst();
	$selectLimit = $tbl_packing_list->UseSelectLimit;
	if (!$selectLimit && $tbl_packing_list->StartRec > 1)
		$tbl_packing_list->Recordset->move($tbl_packing_list->StartRec - 1);
} elseif (!$tbl_packing->AllowAddDeleteRow && $tbl_packing_list->StopRec == 0) {
	$tbl_packing_list->StopRec = $tbl_packing->GridAddRowCount;
}

// Initialize aggregate
$tbl_packing->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_packing->resetAttributes();
$tbl_packing_list->renderRow();
while ($tbl_packing_list->RecCnt < $tbl_packing_list->StopRec) {
	$tbl_packing_list->RecCnt++;
	if ($tbl_packing_list->RecCnt >= $tbl_packing_list->StartRec) {
		$tbl_packing_list->RowCnt++;

		// Set up key count
		$tbl_packing_list->KeyCount = $tbl_packing_list->RowIndex;

		// Init row class and style
		$tbl_packing->resetAttributes();
		$tbl_packing->CssClass = "";
		if ($tbl_packing->isGridAdd()) {
		} else {
			$tbl_packing_list->loadRowValues($tbl_packing_list->Recordset); // Load row values
		}
		$tbl_packing->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_packing->RowAttrs = array_merge($tbl_packing->RowAttrs, array('data-rowindex'=>$tbl_packing_list->RowCnt, 'id'=>'r' . $tbl_packing_list->RowCnt . '_tbl_packing', 'data-rowtype'=>$tbl_packing->RowType));

		// Render row
		$tbl_packing_list->renderRow();

		// Render list options
		$tbl_packing_list->renderListOptions();
?>
	<tr<?php echo $tbl_packing->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_packing_list->ListOptions->render("body", "left", $tbl_packing_list->RowCnt);
?>
	<?php if ($tbl_packing->Id_order->Visible) { // Id_order ?>
		<td data-name="Id_order"<?php echo $tbl_packing->Id_order->cellAttributes() ?>>
<span id="el<?php echo $tbl_packing_list->RowCnt ?>_tbl_packing_Id_order" class="tbl_packing_Id_order">
<span<?php echo $tbl_packing->Id_order->viewAttributes() ?>>
<?php echo $tbl_packing->Id_order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_packing->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_packing->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_packing_list->RowCnt ?>_tbl_packing_CreateUser" class="tbl_packing_CreateUser">
<span<?php echo $tbl_packing->CreateUser->viewAttributes() ?>>
<?php echo $tbl_packing->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_packing->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_packing->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_packing_list->RowCnt ?>_tbl_packing_CreateDate" class="tbl_packing_CreateDate">
<span<?php echo $tbl_packing->CreateDate->viewAttributes() ?>>
<?php echo $tbl_packing->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_packing_list->ListOptions->render("body", "right", $tbl_packing_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_packing->isGridAdd())
		$tbl_packing_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_packing->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_packing_list->Recordset)
	$tbl_packing_list->Recordset->Close();
?>
<?php if (!$tbl_packing->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_packing->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_packing_list->Pager)) $tbl_packing_list->Pager = new PrevNextPager($tbl_packing_list->StartRec, $tbl_packing_list->DisplayRecs, $tbl_packing_list->TotalRecs, $tbl_packing_list->AutoHidePager) ?>
<?php if ($tbl_packing_list->Pager->RecordCount > 0 && $tbl_packing_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_packing_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_packing_list->pageUrl() ?>start=<?php echo $tbl_packing_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_packing_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_packing_list->pageUrl() ?>start=<?php echo $tbl_packing_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_packing_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_packing_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_packing_list->pageUrl() ?>start=<?php echo $tbl_packing_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_packing_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_packing_list->pageUrl() ?>start=<?php echo $tbl_packing_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_packing_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_packing_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_packing_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_packing_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_packing_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_packing_list->TotalRecs > 0 && (!$tbl_packing_list->AutoHidePageSizeSelector || $tbl_packing_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_packing">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_packing_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_packing_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_packing_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_packing_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_packing_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_packing->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_packing_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_packing_list->TotalRecs == 0 && !$tbl_packing->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_packing_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_packing_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_packing->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_packing_list->terminate();
?>