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
$tbl_producttype_list = new tbl_producttype_list();

// Run the page
$tbl_producttype_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_producttype_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_producttype->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_producttypelist = currentForm = new ew.Form("ftbl_producttypelist", "list");
ftbl_producttypelist.formKeyCountName = '<?php echo $tbl_producttype_list->FormKeyCountName ?>';

// Validate form
ftbl_producttypelist.validate = function() {
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
		<?php if ($tbl_producttype_list->IdType->Required) { ?>
			elm = this.getElements("x" + infix + "_IdType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_producttype->IdType->caption(), $tbl_producttype->IdType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_producttype_list->TypeName->Required) { ?>
			elm = this.getElements("x" + infix + "_TypeName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_producttype->TypeName->caption(), $tbl_producttype->TypeName->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_producttypelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_producttypelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftbl_producttypelistsrch = currentSearchForm = new ew.Form("ftbl_producttypelistsrch");

// Filters
ftbl_producttypelistsrch.filterList = <?php echo $tbl_producttype_list->getFilterList() ?>;
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
<?php if (!$tbl_producttype->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_producttype_list->TotalRecs > 0 && $tbl_producttype_list->ExportOptions->visible()) { ?>
<?php $tbl_producttype_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_producttype_list->ImportOptions->visible()) { ?>
<?php $tbl_producttype_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_producttype_list->SearchOptions->visible()) { ?>
<?php $tbl_producttype_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_producttype_list->FilterOptions->visible()) { ?>
<?php $tbl_producttype_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_producttype_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_producttype->isExport() && !$tbl_producttype->CurrentAction) { ?>
<form name="ftbl_producttypelistsrch" id="ftbl_producttypelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_producttype_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_producttypelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_producttype">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_producttype_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_producttype_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_producttype_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_producttype_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_producttype_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_producttype_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_producttype_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_producttype_list->showPageHeader(); ?>
<?php
$tbl_producttype_list->showMessage();
?>
<?php if ($tbl_producttype_list->TotalRecs > 0 || $tbl_producttype->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_producttype_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_producttype">
<?php if (!$tbl_producttype->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_producttype->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_producttype_list->Pager)) $tbl_producttype_list->Pager = new PrevNextPager($tbl_producttype_list->StartRec, $tbl_producttype_list->DisplayRecs, $tbl_producttype_list->TotalRecs, $tbl_producttype_list->AutoHidePager) ?>
<?php if ($tbl_producttype_list->Pager->RecordCount > 0 && $tbl_producttype_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_producttype_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_producttype_list->pageUrl() ?>start=<?php echo $tbl_producttype_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_producttype_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_producttype_list->pageUrl() ?>start=<?php echo $tbl_producttype_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_producttype_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_producttype_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_producttype_list->pageUrl() ?>start=<?php echo $tbl_producttype_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_producttype_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_producttype_list->pageUrl() ?>start=<?php echo $tbl_producttype_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_producttype_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_producttype_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_producttype_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_producttype_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_producttype_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_producttype_list->TotalRecs > 0 && (!$tbl_producttype_list->AutoHidePageSizeSelector || $tbl_producttype_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_producttype">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_producttype_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_producttype_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_producttype_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_producttype_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_producttype_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_producttype->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_producttype_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_producttypelist" id="ftbl_producttypelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_producttype_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_producttype_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_producttype">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_producttype" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_producttype_list->TotalRecs > 0 || $tbl_producttype->isAdd() || $tbl_producttype->isCopy() || $tbl_producttype->isGridEdit()) { ?>
<table id="tbl_tbl_producttypelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_producttype_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_producttype_list->renderListOptions();

// Render list options (header, left)
$tbl_producttype_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_producttype->IdType->Visible) { // IdType ?>
	<?php if ($tbl_producttype->sortUrl($tbl_producttype->IdType) == "") { ?>
		<th data-name="IdType" class="<?php echo $tbl_producttype->IdType->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_producttype_IdType" class="tbl_producttype_IdType"><div class="ew-table-header-caption"><?php echo $tbl_producttype->IdType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IdType" class="<?php echo $tbl_producttype->IdType->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_producttype->SortUrl($tbl_producttype->IdType) ?>',2);"><div id="elh_tbl_producttype_IdType" class="tbl_producttype_IdType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_producttype->IdType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_producttype->IdType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_producttype->IdType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_producttype->TypeName->Visible) { // TypeName ?>
	<?php if ($tbl_producttype->sortUrl($tbl_producttype->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $tbl_producttype->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_producttype_TypeName" class="tbl_producttype_TypeName"><div class="ew-table-header-caption"><?php echo $tbl_producttype->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $tbl_producttype->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_producttype->SortUrl($tbl_producttype->TypeName) ?>',2);"><div id="elh_tbl_producttype_TypeName" class="tbl_producttype_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_producttype->TypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_producttype->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_producttype->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_producttype_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($tbl_producttype->isAdd() || $tbl_producttype->isCopy()) {
		$tbl_producttype_list->RowIndex = 0;
		$tbl_producttype_list->KeyCount = $tbl_producttype_list->RowIndex;
		if ($tbl_producttype->isAdd())
			$tbl_producttype_list->loadRowValues();
		if ($tbl_producttype->EventCancelled) // Insert failed
			$tbl_producttype_list->restoreFormValues(); // Restore form values

		// Set row properties
		$tbl_producttype->resetAttributes();
		$tbl_producttype->RowAttrs = array_merge($tbl_producttype->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_tbl_producttype', 'data-rowtype'=>ROWTYPE_ADD));
		$tbl_producttype->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_producttype_list->renderRow();

		// Render list options
		$tbl_producttype_list->renderListOptions();
		$tbl_producttype_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_producttype->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_producttype_list->ListOptions->render("body", "left", $tbl_producttype_list->RowCnt);
?>
	<?php if ($tbl_producttype->IdType->Visible) { // IdType ?>
		<td data-name="IdType">
<span id="el<?php echo $tbl_producttype_list->RowCnt ?>_tbl_producttype_IdType" class="form-group tbl_producttype_IdType">
<input type="text" data-table="tbl_producttype" data-field="x_IdType" name="x<?php echo $tbl_producttype_list->RowIndex ?>_IdType" id="x<?php echo $tbl_producttype_list->RowIndex ?>_IdType" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($tbl_producttype->IdType->getPlaceHolder()) ?>" value="<?php echo $tbl_producttype->IdType->EditValue ?>"<?php echo $tbl_producttype->IdType->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_producttype" data-field="x_IdType" name="o<?php echo $tbl_producttype_list->RowIndex ?>_IdType" id="o<?php echo $tbl_producttype_list->RowIndex ?>_IdType" value="<?php echo HtmlEncode($tbl_producttype->IdType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_producttype->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName">
<span id="el<?php echo $tbl_producttype_list->RowCnt ?>_tbl_producttype_TypeName" class="form-group tbl_producttype_TypeName">
<input type="text" data-table="tbl_producttype" data-field="x_TypeName" name="x<?php echo $tbl_producttype_list->RowIndex ?>_TypeName" id="x<?php echo $tbl_producttype_list->RowIndex ?>_TypeName" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($tbl_producttype->TypeName->getPlaceHolder()) ?>" value="<?php echo $tbl_producttype->TypeName->EditValue ?>"<?php echo $tbl_producttype->TypeName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_producttype" data-field="x_TypeName" name="o<?php echo $tbl_producttype_list->RowIndex ?>_TypeName" id="o<?php echo $tbl_producttype_list->RowIndex ?>_TypeName" value="<?php echo HtmlEncode($tbl_producttype->TypeName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_producttype_list->ListOptions->render("body", "right", $tbl_producttype_list->RowCnt);
?>
<script>
ftbl_producttypelist.updateLists(<?php echo $tbl_producttype_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($tbl_producttype->ExportAll && $tbl_producttype->isExport()) {
	$tbl_producttype_list->StopRec = $tbl_producttype_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_producttype_list->TotalRecs > $tbl_producttype_list->StartRec + $tbl_producttype_list->DisplayRecs - 1)
		$tbl_producttype_list->StopRec = $tbl_producttype_list->StartRec + $tbl_producttype_list->DisplayRecs - 1;
	else
		$tbl_producttype_list->StopRec = $tbl_producttype_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_producttype_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_producttype_list->FormKeyCountName) && ($tbl_producttype->isGridAdd() || $tbl_producttype->isGridEdit() || $tbl_producttype->isConfirm())) {
		$tbl_producttype_list->KeyCount = $CurrentForm->getValue($tbl_producttype_list->FormKeyCountName);
		$tbl_producttype_list->StopRec = $tbl_producttype_list->StartRec + $tbl_producttype_list->KeyCount - 1;
	}
}
$tbl_producttype_list->RecCnt = $tbl_producttype_list->StartRec - 1;
if ($tbl_producttype_list->Recordset && !$tbl_producttype_list->Recordset->EOF) {
	$tbl_producttype_list->Recordset->moveFirst();
	$selectLimit = $tbl_producttype_list->UseSelectLimit;
	if (!$selectLimit && $tbl_producttype_list->StartRec > 1)
		$tbl_producttype_list->Recordset->move($tbl_producttype_list->StartRec - 1);
} elseif (!$tbl_producttype->AllowAddDeleteRow && $tbl_producttype_list->StopRec == 0) {
	$tbl_producttype_list->StopRec = $tbl_producttype->GridAddRowCount;
}

// Initialize aggregate
$tbl_producttype->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_producttype->resetAttributes();
$tbl_producttype_list->renderRow();
$tbl_producttype_list->EditRowCnt = 0;
if ($tbl_producttype->isEdit())
	$tbl_producttype_list->RowIndex = 1;
while ($tbl_producttype_list->RecCnt < $tbl_producttype_list->StopRec) {
	$tbl_producttype_list->RecCnt++;
	if ($tbl_producttype_list->RecCnt >= $tbl_producttype_list->StartRec) {
		$tbl_producttype_list->RowCnt++;

		// Set up key count
		$tbl_producttype_list->KeyCount = $tbl_producttype_list->RowIndex;

		// Init row class and style
		$tbl_producttype->resetAttributes();
		$tbl_producttype->CssClass = "";
		if ($tbl_producttype->isGridAdd()) {
			$tbl_producttype_list->loadRowValues(); // Load default values
		} else {
			$tbl_producttype_list->loadRowValues($tbl_producttype_list->Recordset); // Load row values
		}
		$tbl_producttype->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_producttype->isEdit()) {
			if ($tbl_producttype_list->checkInlineEditKey() && $tbl_producttype_list->EditRowCnt == 0) { // Inline edit
				$tbl_producttype->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_producttype->isEdit() && $tbl_producttype->RowType == ROWTYPE_EDIT && $tbl_producttype->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_producttype_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_producttype->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_producttype_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_producttype->RowAttrs = array_merge($tbl_producttype->RowAttrs, array('data-rowindex'=>$tbl_producttype_list->RowCnt, 'id'=>'r' . $tbl_producttype_list->RowCnt . '_tbl_producttype', 'data-rowtype'=>$tbl_producttype->RowType));

		// Render row
		$tbl_producttype_list->renderRow();

		// Render list options
		$tbl_producttype_list->renderListOptions();
?>
	<tr<?php echo $tbl_producttype->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_producttype_list->ListOptions->render("body", "left", $tbl_producttype_list->RowCnt);
?>
	<?php if ($tbl_producttype->IdType->Visible) { // IdType ?>
		<td data-name="IdType"<?php echo $tbl_producttype->IdType->cellAttributes() ?>>
<?php if ($tbl_producttype->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_producttype_list->RowCnt ?>_tbl_producttype_IdType" class="form-group tbl_producttype_IdType">
<span<?php echo $tbl_producttype->IdType->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_producttype->IdType->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_producttype" data-field="x_IdType" name="x<?php echo $tbl_producttype_list->RowIndex ?>_IdType" id="x<?php echo $tbl_producttype_list->RowIndex ?>_IdType" value="<?php echo HtmlEncode($tbl_producttype->IdType->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_producttype->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_producttype_list->RowCnt ?>_tbl_producttype_IdType" class="tbl_producttype_IdType">
<span<?php echo $tbl_producttype->IdType->viewAttributes() ?>>
<?php echo $tbl_producttype->IdType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_producttype->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $tbl_producttype->TypeName->cellAttributes() ?>>
<?php if ($tbl_producttype->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_producttype_list->RowCnt ?>_tbl_producttype_TypeName" class="form-group tbl_producttype_TypeName">
<input type="text" data-table="tbl_producttype" data-field="x_TypeName" name="x<?php echo $tbl_producttype_list->RowIndex ?>_TypeName" id="x<?php echo $tbl_producttype_list->RowIndex ?>_TypeName" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($tbl_producttype->TypeName->getPlaceHolder()) ?>" value="<?php echo $tbl_producttype->TypeName->EditValue ?>"<?php echo $tbl_producttype->TypeName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_producttype->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_producttype_list->RowCnt ?>_tbl_producttype_TypeName" class="tbl_producttype_TypeName">
<span<?php echo $tbl_producttype->TypeName->viewAttributes() ?>>
<?php echo $tbl_producttype->TypeName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_producttype_list->ListOptions->render("body", "right", $tbl_producttype_list->RowCnt);
?>
	</tr>
<?php if ($tbl_producttype->RowType == ROWTYPE_ADD || $tbl_producttype->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_producttypelist.updateLists(<?php echo $tbl_producttype_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if (!$tbl_producttype->isGridAdd())
		$tbl_producttype_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_producttype->isAdd() || $tbl_producttype->isCopy()) { ?>
<input type="hidden" name="<?php echo $tbl_producttype_list->FormKeyCountName ?>" id="<?php echo $tbl_producttype_list->FormKeyCountName ?>" value="<?php echo $tbl_producttype_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_producttype->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_producttype_list->FormKeyCountName ?>" id="<?php echo $tbl_producttype_list->FormKeyCountName ?>" value="<?php echo $tbl_producttype_list->KeyCount ?>">
<?php } ?>
<?php if (!$tbl_producttype->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_producttype_list->Recordset)
	$tbl_producttype_list->Recordset->Close();
?>
<?php if (!$tbl_producttype->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_producttype->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_producttype_list->Pager)) $tbl_producttype_list->Pager = new PrevNextPager($tbl_producttype_list->StartRec, $tbl_producttype_list->DisplayRecs, $tbl_producttype_list->TotalRecs, $tbl_producttype_list->AutoHidePager) ?>
<?php if ($tbl_producttype_list->Pager->RecordCount > 0 && $tbl_producttype_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_producttype_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_producttype_list->pageUrl() ?>start=<?php echo $tbl_producttype_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_producttype_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_producttype_list->pageUrl() ?>start=<?php echo $tbl_producttype_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_producttype_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_producttype_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_producttype_list->pageUrl() ?>start=<?php echo $tbl_producttype_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_producttype_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_producttype_list->pageUrl() ?>start=<?php echo $tbl_producttype_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_producttype_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_producttype_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_producttype_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_producttype_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_producttype_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_producttype_list->TotalRecs > 0 && (!$tbl_producttype_list->AutoHidePageSizeSelector || $tbl_producttype_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_producttype">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_producttype_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_producttype_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_producttype_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_producttype_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_producttype_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_producttype->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_producttype_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_producttype_list->TotalRecs == 0 && !$tbl_producttype->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_producttype_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_producttype_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_producttype->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_producttype_list->terminate();
?>