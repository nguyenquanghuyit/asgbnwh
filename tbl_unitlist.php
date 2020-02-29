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
$tbl_unit_list = new tbl_unit_list();

// Run the page
$tbl_unit_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unit_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_unit->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_unitlist = currentForm = new ew.Form("ftbl_unitlist", "list");
ftbl_unitlist.formKeyCountName = '<?php echo $tbl_unit_list->FormKeyCountName ?>';

// Validate form
ftbl_unitlist.validate = function() {
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
		<?php if ($tbl_unit_list->idUnit->Required) { ?>
			elm = this.getElements("x" + infix + "_idUnit");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unit->idUnit->caption(), $tbl_unit->idUnit->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unit_list->UnitName->Required) { ?>
			elm = this.getElements("x" + infix + "_UnitName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unit->UnitName->caption(), $tbl_unit->UnitName->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_unitlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_unitlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftbl_unitlistsrch = currentSearchForm = new ew.Form("ftbl_unitlistsrch");

// Filters
ftbl_unitlistsrch.filterList = <?php echo $tbl_unit_list->getFilterList() ?>;
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
<?php if (!$tbl_unit->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_unit_list->TotalRecs > 0 && $tbl_unit_list->ExportOptions->visible()) { ?>
<?php $tbl_unit_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_unit_list->ImportOptions->visible()) { ?>
<?php $tbl_unit_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_unit_list->SearchOptions->visible()) { ?>
<?php $tbl_unit_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_unit_list->FilterOptions->visible()) { ?>
<?php $tbl_unit_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_unit_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_unit->isExport() && !$tbl_unit->CurrentAction) { ?>
<form name="ftbl_unitlistsrch" id="ftbl_unitlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_unit_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_unitlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_unit">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_unit_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_unit_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_unit_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_unit_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_unit_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_unit_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_unit_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_unit_list->showPageHeader(); ?>
<?php
$tbl_unit_list->showMessage();
?>
<?php if ($tbl_unit_list->TotalRecs > 0 || $tbl_unit->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_unit_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_unit">
<?php if (!$tbl_unit->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_unit->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_unit_list->Pager)) $tbl_unit_list->Pager = new PrevNextPager($tbl_unit_list->StartRec, $tbl_unit_list->DisplayRecs, $tbl_unit_list->TotalRecs, $tbl_unit_list->AutoHidePager) ?>
<?php if ($tbl_unit_list->Pager->RecordCount > 0 && $tbl_unit_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_unit_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_unit_list->pageUrl() ?>start=<?php echo $tbl_unit_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_unit_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_unit_list->pageUrl() ?>start=<?php echo $tbl_unit_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_unit_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_unit_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_unit_list->pageUrl() ?>start=<?php echo $tbl_unit_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_unit_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_unit_list->pageUrl() ?>start=<?php echo $tbl_unit_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_unit_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_unit_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_unit_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_unit_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_unit_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_unit_list->TotalRecs > 0 && (!$tbl_unit_list->AutoHidePageSizeSelector || $tbl_unit_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_unit">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_unit_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_unit_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_unit_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_unit_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_unit_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_unit->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_unit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_unitlist" id="ftbl_unitlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_unit_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_unit_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_unit">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_unit" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_unit_list->TotalRecs > 0 || $tbl_unit->isAdd() || $tbl_unit->isCopy() || $tbl_unit->isGridEdit()) { ?>
<table id="tbl_tbl_unitlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_unit_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_unit_list->renderListOptions();

// Render list options (header, left)
$tbl_unit_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_unit->idUnit->Visible) { // idUnit ?>
	<?php if ($tbl_unit->sortUrl($tbl_unit->idUnit) == "") { ?>
		<th data-name="idUnit" class="<?php echo $tbl_unit->idUnit->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unit_idUnit" class="tbl_unit_idUnit"><div class="ew-table-header-caption"><?php echo $tbl_unit->idUnit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idUnit" class="<?php echo $tbl_unit->idUnit->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_unit->SortUrl($tbl_unit->idUnit) ?>',2);"><div id="elh_tbl_unit_idUnit" class="tbl_unit_idUnit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unit->idUnit->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unit->idUnit->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unit->idUnit->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unit->UnitName->Visible) { // UnitName ?>
	<?php if ($tbl_unit->sortUrl($tbl_unit->UnitName) == "") { ?>
		<th data-name="UnitName" class="<?php echo $tbl_unit->UnitName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unit_UnitName" class="tbl_unit_UnitName"><div class="ew-table-header-caption"><?php echo $tbl_unit->UnitName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitName" class="<?php echo $tbl_unit->UnitName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_unit->SortUrl($tbl_unit->UnitName) ?>',2);"><div id="elh_tbl_unit_UnitName" class="tbl_unit_UnitName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unit->UnitName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_unit->UnitName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unit->UnitName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_unit_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($tbl_unit->isAdd() || $tbl_unit->isCopy()) {
		$tbl_unit_list->RowIndex = 0;
		$tbl_unit_list->KeyCount = $tbl_unit_list->RowIndex;
		if ($tbl_unit->isAdd())
			$tbl_unit_list->loadRowValues();
		if ($tbl_unit->EventCancelled) // Insert failed
			$tbl_unit_list->restoreFormValues(); // Restore form values

		// Set row properties
		$tbl_unit->resetAttributes();
		$tbl_unit->RowAttrs = array_merge($tbl_unit->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_tbl_unit', 'data-rowtype'=>ROWTYPE_ADD));
		$tbl_unit->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_unit_list->renderRow();

		// Render list options
		$tbl_unit_list->renderListOptions();
		$tbl_unit_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_unit->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_unit_list->ListOptions->render("body", "left", $tbl_unit_list->RowCnt);
?>
	<?php if ($tbl_unit->idUnit->Visible) { // idUnit ?>
		<td data-name="idUnit">
<input type="hidden" data-table="tbl_unit" data-field="x_idUnit" name="o<?php echo $tbl_unit_list->RowIndex ?>_idUnit" id="o<?php echo $tbl_unit_list->RowIndex ?>_idUnit" value="<?php echo HtmlEncode($tbl_unit->idUnit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unit->UnitName->Visible) { // UnitName ?>
		<td data-name="UnitName">
<span id="el<?php echo $tbl_unit_list->RowCnt ?>_tbl_unit_UnitName" class="form-group tbl_unit_UnitName">
<input type="text" data-table="tbl_unit" data-field="x_UnitName" name="x<?php echo $tbl_unit_list->RowIndex ?>_UnitName" id="x<?php echo $tbl_unit_list->RowIndex ?>_UnitName" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($tbl_unit->UnitName->getPlaceHolder()) ?>" value="<?php echo $tbl_unit->UnitName->EditValue ?>"<?php echo $tbl_unit->UnitName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unit" data-field="x_UnitName" name="o<?php echo $tbl_unit_list->RowIndex ?>_UnitName" id="o<?php echo $tbl_unit_list->RowIndex ?>_UnitName" value="<?php echo HtmlEncode($tbl_unit->UnitName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_unit_list->ListOptions->render("body", "right", $tbl_unit_list->RowCnt);
?>
<script>
ftbl_unitlist.updateLists(<?php echo $tbl_unit_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($tbl_unit->ExportAll && $tbl_unit->isExport()) {
	$tbl_unit_list->StopRec = $tbl_unit_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_unit_list->TotalRecs > $tbl_unit_list->StartRec + $tbl_unit_list->DisplayRecs - 1)
		$tbl_unit_list->StopRec = $tbl_unit_list->StartRec + $tbl_unit_list->DisplayRecs - 1;
	else
		$tbl_unit_list->StopRec = $tbl_unit_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_unit_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_unit_list->FormKeyCountName) && ($tbl_unit->isGridAdd() || $tbl_unit->isGridEdit() || $tbl_unit->isConfirm())) {
		$tbl_unit_list->KeyCount = $CurrentForm->getValue($tbl_unit_list->FormKeyCountName);
		$tbl_unit_list->StopRec = $tbl_unit_list->StartRec + $tbl_unit_list->KeyCount - 1;
	}
}
$tbl_unit_list->RecCnt = $tbl_unit_list->StartRec - 1;
if ($tbl_unit_list->Recordset && !$tbl_unit_list->Recordset->EOF) {
	$tbl_unit_list->Recordset->moveFirst();
	$selectLimit = $tbl_unit_list->UseSelectLimit;
	if (!$selectLimit && $tbl_unit_list->StartRec > 1)
		$tbl_unit_list->Recordset->move($tbl_unit_list->StartRec - 1);
} elseif (!$tbl_unit->AllowAddDeleteRow && $tbl_unit_list->StopRec == 0) {
	$tbl_unit_list->StopRec = $tbl_unit->GridAddRowCount;
}

// Initialize aggregate
$tbl_unit->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_unit->resetAttributes();
$tbl_unit_list->renderRow();
$tbl_unit_list->EditRowCnt = 0;
if ($tbl_unit->isEdit())
	$tbl_unit_list->RowIndex = 1;
while ($tbl_unit_list->RecCnt < $tbl_unit_list->StopRec) {
	$tbl_unit_list->RecCnt++;
	if ($tbl_unit_list->RecCnt >= $tbl_unit_list->StartRec) {
		$tbl_unit_list->RowCnt++;

		// Set up key count
		$tbl_unit_list->KeyCount = $tbl_unit_list->RowIndex;

		// Init row class and style
		$tbl_unit->resetAttributes();
		$tbl_unit->CssClass = "";
		if ($tbl_unit->isGridAdd()) {
			$tbl_unit_list->loadRowValues(); // Load default values
		} else {
			$tbl_unit_list->loadRowValues($tbl_unit_list->Recordset); // Load row values
		}
		$tbl_unit->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_unit->isEdit()) {
			if ($tbl_unit_list->checkInlineEditKey() && $tbl_unit_list->EditRowCnt == 0) { // Inline edit
				$tbl_unit->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_unit->isEdit() && $tbl_unit->RowType == ROWTYPE_EDIT && $tbl_unit->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_unit_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_unit->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_unit_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_unit->RowAttrs = array_merge($tbl_unit->RowAttrs, array('data-rowindex'=>$tbl_unit_list->RowCnt, 'id'=>'r' . $tbl_unit_list->RowCnt . '_tbl_unit', 'data-rowtype'=>$tbl_unit->RowType));

		// Render row
		$tbl_unit_list->renderRow();

		// Render list options
		$tbl_unit_list->renderListOptions();
?>
	<tr<?php echo $tbl_unit->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_unit_list->ListOptions->render("body", "left", $tbl_unit_list->RowCnt);
?>
	<?php if ($tbl_unit->idUnit->Visible) { // idUnit ?>
		<td data-name="idUnit"<?php echo $tbl_unit->idUnit->cellAttributes() ?>>
<?php if ($tbl_unit->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unit_list->RowCnt ?>_tbl_unit_idUnit" class="form-group tbl_unit_idUnit">
<span<?php echo $tbl_unit->idUnit->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unit->idUnit->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unit" data-field="x_idUnit" name="x<?php echo $tbl_unit_list->RowIndex ?>_idUnit" id="x<?php echo $tbl_unit_list->RowIndex ?>_idUnit" value="<?php echo HtmlEncode($tbl_unit->idUnit->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_unit->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unit_list->RowCnt ?>_tbl_unit_idUnit" class="tbl_unit_idUnit">
<span<?php echo $tbl_unit->idUnit->viewAttributes() ?>>
<?php echo $tbl_unit->idUnit->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_unit->UnitName->Visible) { // UnitName ?>
		<td data-name="UnitName"<?php echo $tbl_unit->UnitName->cellAttributes() ?>>
<?php if ($tbl_unit->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unit_list->RowCnt ?>_tbl_unit_UnitName" class="form-group tbl_unit_UnitName">
<input type="text" data-table="tbl_unit" data-field="x_UnitName" name="x<?php echo $tbl_unit_list->RowIndex ?>_UnitName" id="x<?php echo $tbl_unit_list->RowIndex ?>_UnitName" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($tbl_unit->UnitName->getPlaceHolder()) ?>" value="<?php echo $tbl_unit->UnitName->EditValue ?>"<?php echo $tbl_unit->UnitName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_unit->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unit_list->RowCnt ?>_tbl_unit_UnitName" class="tbl_unit_UnitName">
<span<?php echo $tbl_unit->UnitName->viewAttributes() ?>>
<?php echo $tbl_unit->UnitName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_unit_list->ListOptions->render("body", "right", $tbl_unit_list->RowCnt);
?>
	</tr>
<?php if ($tbl_unit->RowType == ROWTYPE_ADD || $tbl_unit->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_unitlist.updateLists(<?php echo $tbl_unit_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if (!$tbl_unit->isGridAdd())
		$tbl_unit_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_unit->isAdd() || $tbl_unit->isCopy()) { ?>
<input type="hidden" name="<?php echo $tbl_unit_list->FormKeyCountName ?>" id="<?php echo $tbl_unit_list->FormKeyCountName ?>" value="<?php echo $tbl_unit_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_unit->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_unit_list->FormKeyCountName ?>" id="<?php echo $tbl_unit_list->FormKeyCountName ?>" value="<?php echo $tbl_unit_list->KeyCount ?>">
<?php } ?>
<?php if (!$tbl_unit->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_unit_list->Recordset)
	$tbl_unit_list->Recordset->Close();
?>
<?php if (!$tbl_unit->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_unit->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_unit_list->Pager)) $tbl_unit_list->Pager = new PrevNextPager($tbl_unit_list->StartRec, $tbl_unit_list->DisplayRecs, $tbl_unit_list->TotalRecs, $tbl_unit_list->AutoHidePager) ?>
<?php if ($tbl_unit_list->Pager->RecordCount > 0 && $tbl_unit_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_unit_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_unit_list->pageUrl() ?>start=<?php echo $tbl_unit_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_unit_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_unit_list->pageUrl() ?>start=<?php echo $tbl_unit_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_unit_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_unit_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_unit_list->pageUrl() ?>start=<?php echo $tbl_unit_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_unit_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_unit_list->pageUrl() ?>start=<?php echo $tbl_unit_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_unit_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_unit_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_unit_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_unit_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_unit_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_unit_list->TotalRecs > 0 && (!$tbl_unit_list->AutoHidePageSizeSelector || $tbl_unit_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_unit">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_unit_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_unit_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_unit_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_unit_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_unit_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_unit->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_unit_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_unit_list->TotalRecs == 0 && !$tbl_unit->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_unit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_unit_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_unit->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_unit_list->terminate();
?>