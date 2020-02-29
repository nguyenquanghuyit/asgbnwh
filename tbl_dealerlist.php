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
$tbl_dealer_list = new tbl_dealer_list();

// Run the page
$tbl_dealer_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_dealer_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_dealer->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_dealerlist = currentForm = new ew.Form("ftbl_dealerlist", "list");
ftbl_dealerlist.formKeyCountName = '<?php echo $tbl_dealer_list->FormKeyCountName ?>';

// Validate form
ftbl_dealerlist.validate = function() {
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
		<?php if ($tbl_dealer_list->DealerName->Required) { ?>
			elm = this.getElements("x" + infix + "_DealerName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_dealer->DealerName->caption(), $tbl_dealer->DealerName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_dealer_list->Address->Required) { ?>
			elm = this.getElements("x" + infix + "_Address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_dealer->Address->caption(), $tbl_dealer->Address->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_dealerlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_dealerlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftbl_dealerlistsrch = currentSearchForm = new ew.Form("ftbl_dealerlistsrch");

// Filters
ftbl_dealerlistsrch.filterList = <?php echo $tbl_dealer_list->getFilterList() ?>;
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
<?php if (!$tbl_dealer->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_dealer_list->TotalRecs > 0 && $tbl_dealer_list->ExportOptions->visible()) { ?>
<?php $tbl_dealer_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_dealer_list->ImportOptions->visible()) { ?>
<?php $tbl_dealer_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_dealer_list->SearchOptions->visible()) { ?>
<?php $tbl_dealer_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_dealer_list->FilterOptions->visible()) { ?>
<?php $tbl_dealer_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_dealer_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_dealer->isExport() && !$tbl_dealer->CurrentAction) { ?>
<form name="ftbl_dealerlistsrch" id="ftbl_dealerlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_dealer_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_dealerlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_dealer">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_dealer_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_dealer_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_dealer_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_dealer_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_dealer_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_dealer_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_dealer_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_dealer_list->showPageHeader(); ?>
<?php
$tbl_dealer_list->showMessage();
?>
<?php if ($tbl_dealer_list->TotalRecs > 0 || $tbl_dealer->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_dealer_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_dealer">
<?php if (!$tbl_dealer->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_dealer->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_dealer_list->Pager)) $tbl_dealer_list->Pager = new PrevNextPager($tbl_dealer_list->StartRec, $tbl_dealer_list->DisplayRecs, $tbl_dealer_list->TotalRecs, $tbl_dealer_list->AutoHidePager) ?>
<?php if ($tbl_dealer_list->Pager->RecordCount > 0 && $tbl_dealer_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_dealer_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_dealer_list->pageUrl() ?>start=<?php echo $tbl_dealer_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_dealer_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_dealer_list->pageUrl() ?>start=<?php echo $tbl_dealer_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_dealer_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_dealer_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_dealer_list->pageUrl() ?>start=<?php echo $tbl_dealer_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_dealer_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_dealer_list->pageUrl() ?>start=<?php echo $tbl_dealer_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_dealer_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_dealer_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_dealer_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_dealer_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_dealer_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_dealer_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_dealerlist" id="ftbl_dealerlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_dealer_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_dealer_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_dealer">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_dealer" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_dealer_list->TotalRecs > 0 || $tbl_dealer->isAdd() || $tbl_dealer->isCopy() || $tbl_dealer->isGridEdit()) { ?>
<table id="tbl_tbl_dealerlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_dealer_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_dealer_list->renderListOptions();

// Render list options (header, left)
$tbl_dealer_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_dealer->DealerName->Visible) { // DealerName ?>
	<?php if ($tbl_dealer->sortUrl($tbl_dealer->DealerName) == "") { ?>
		<th data-name="DealerName" class="<?php echo $tbl_dealer->DealerName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_dealer_DealerName" class="tbl_dealer_DealerName"><div class="ew-table-header-caption"><?php echo $tbl_dealer->DealerName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DealerName" class="<?php echo $tbl_dealer->DealerName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_dealer->SortUrl($tbl_dealer->DealerName) ?>',2);"><div id="elh_tbl_dealer_DealerName" class="tbl_dealer_DealerName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_dealer->DealerName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_dealer->DealerName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_dealer->DealerName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_dealer->Address->Visible) { // Address ?>
	<?php if ($tbl_dealer->sortUrl($tbl_dealer->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $tbl_dealer->Address->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_dealer_Address" class="tbl_dealer_Address"><div class="ew-table-header-caption"><?php echo $tbl_dealer->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $tbl_dealer->Address->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_dealer->SortUrl($tbl_dealer->Address) ?>',2);"><div id="elh_tbl_dealer_Address" class="tbl_dealer_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_dealer->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_dealer->Address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_dealer->Address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_dealer_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($tbl_dealer->isAdd() || $tbl_dealer->isCopy()) {
		$tbl_dealer_list->RowIndex = 0;
		$tbl_dealer_list->KeyCount = $tbl_dealer_list->RowIndex;
		if ($tbl_dealer->isAdd())
			$tbl_dealer_list->loadRowValues();
		if ($tbl_dealer->EventCancelled) // Insert failed
			$tbl_dealer_list->restoreFormValues(); // Restore form values

		// Set row properties
		$tbl_dealer->resetAttributes();
		$tbl_dealer->RowAttrs = array_merge($tbl_dealer->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_tbl_dealer', 'data-rowtype'=>ROWTYPE_ADD));
		$tbl_dealer->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_dealer_list->renderRow();

		// Render list options
		$tbl_dealer_list->renderListOptions();
		$tbl_dealer_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_dealer->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_dealer_list->ListOptions->render("body", "left", $tbl_dealer_list->RowCnt);
?>
	<?php if ($tbl_dealer->DealerName->Visible) { // DealerName ?>
		<td data-name="DealerName">
<span id="el<?php echo $tbl_dealer_list->RowCnt ?>_tbl_dealer_DealerName" class="form-group tbl_dealer_DealerName">
<input type="text" data-table="tbl_dealer" data-field="x_DealerName" name="x<?php echo $tbl_dealer_list->RowIndex ?>_DealerName" id="x<?php echo $tbl_dealer_list->RowIndex ?>_DealerName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_dealer->DealerName->getPlaceHolder()) ?>" value="<?php echo $tbl_dealer->DealerName->EditValue ?>"<?php echo $tbl_dealer->DealerName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_dealer" data-field="x_DealerName" name="o<?php echo $tbl_dealer_list->RowIndex ?>_DealerName" id="o<?php echo $tbl_dealer_list->RowIndex ?>_DealerName" value="<?php echo HtmlEncode($tbl_dealer->DealerName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_dealer->Address->Visible) { // Address ?>
		<td data-name="Address">
<span id="el<?php echo $tbl_dealer_list->RowCnt ?>_tbl_dealer_Address" class="form-group tbl_dealer_Address">
<input type="text" data-table="tbl_dealer" data-field="x_Address" name="x<?php echo $tbl_dealer_list->RowIndex ?>_Address" id="x<?php echo $tbl_dealer_list->RowIndex ?>_Address" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_dealer->Address->getPlaceHolder()) ?>" value="<?php echo $tbl_dealer->Address->EditValue ?>"<?php echo $tbl_dealer->Address->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_dealer" data-field="x_Address" name="o<?php echo $tbl_dealer_list->RowIndex ?>_Address" id="o<?php echo $tbl_dealer_list->RowIndex ?>_Address" value="<?php echo HtmlEncode($tbl_dealer->Address->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_dealer_list->ListOptions->render("body", "right", $tbl_dealer_list->RowCnt);
?>
<script>
ftbl_dealerlist.updateLists(<?php echo $tbl_dealer_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($tbl_dealer->ExportAll && $tbl_dealer->isExport()) {
	$tbl_dealer_list->StopRec = $tbl_dealer_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_dealer_list->TotalRecs > $tbl_dealer_list->StartRec + $tbl_dealer_list->DisplayRecs - 1)
		$tbl_dealer_list->StopRec = $tbl_dealer_list->StartRec + $tbl_dealer_list->DisplayRecs - 1;
	else
		$tbl_dealer_list->StopRec = $tbl_dealer_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_dealer_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_dealer_list->FormKeyCountName) && ($tbl_dealer->isGridAdd() || $tbl_dealer->isGridEdit() || $tbl_dealer->isConfirm())) {
		$tbl_dealer_list->KeyCount = $CurrentForm->getValue($tbl_dealer_list->FormKeyCountName);
		$tbl_dealer_list->StopRec = $tbl_dealer_list->StartRec + $tbl_dealer_list->KeyCount - 1;
	}
}
$tbl_dealer_list->RecCnt = $tbl_dealer_list->StartRec - 1;
if ($tbl_dealer_list->Recordset && !$tbl_dealer_list->Recordset->EOF) {
	$tbl_dealer_list->Recordset->moveFirst();
	$selectLimit = $tbl_dealer_list->UseSelectLimit;
	if (!$selectLimit && $tbl_dealer_list->StartRec > 1)
		$tbl_dealer_list->Recordset->move($tbl_dealer_list->StartRec - 1);
} elseif (!$tbl_dealer->AllowAddDeleteRow && $tbl_dealer_list->StopRec == 0) {
	$tbl_dealer_list->StopRec = $tbl_dealer->GridAddRowCount;
}

// Initialize aggregate
$tbl_dealer->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_dealer->resetAttributes();
$tbl_dealer_list->renderRow();
$tbl_dealer_list->EditRowCnt = 0;
if ($tbl_dealer->isEdit())
	$tbl_dealer_list->RowIndex = 1;
while ($tbl_dealer_list->RecCnt < $tbl_dealer_list->StopRec) {
	$tbl_dealer_list->RecCnt++;
	if ($tbl_dealer_list->RecCnt >= $tbl_dealer_list->StartRec) {
		$tbl_dealer_list->RowCnt++;

		// Set up key count
		$tbl_dealer_list->KeyCount = $tbl_dealer_list->RowIndex;

		// Init row class and style
		$tbl_dealer->resetAttributes();
		$tbl_dealer->CssClass = "";
		if ($tbl_dealer->isGridAdd()) {
			$tbl_dealer_list->loadRowValues(); // Load default values
		} else {
			$tbl_dealer_list->loadRowValues($tbl_dealer_list->Recordset); // Load row values
		}
		$tbl_dealer->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_dealer->isEdit()) {
			if ($tbl_dealer_list->checkInlineEditKey() && $tbl_dealer_list->EditRowCnt == 0) { // Inline edit
				$tbl_dealer->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_dealer->isEdit() && $tbl_dealer->RowType == ROWTYPE_EDIT && $tbl_dealer->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_dealer_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_dealer->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_dealer_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_dealer->RowAttrs = array_merge($tbl_dealer->RowAttrs, array('data-rowindex'=>$tbl_dealer_list->RowCnt, 'id'=>'r' . $tbl_dealer_list->RowCnt . '_tbl_dealer', 'data-rowtype'=>$tbl_dealer->RowType));

		// Render row
		$tbl_dealer_list->renderRow();

		// Render list options
		$tbl_dealer_list->renderListOptions();
?>
	<tr<?php echo $tbl_dealer->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_dealer_list->ListOptions->render("body", "left", $tbl_dealer_list->RowCnt);
?>
	<?php if ($tbl_dealer->DealerName->Visible) { // DealerName ?>
		<td data-name="DealerName"<?php echo $tbl_dealer->DealerName->cellAttributes() ?>>
<?php if ($tbl_dealer->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_dealer_list->RowCnt ?>_tbl_dealer_DealerName" class="form-group tbl_dealer_DealerName">
<input type="text" data-table="tbl_dealer" data-field="x_DealerName" name="x<?php echo $tbl_dealer_list->RowIndex ?>_DealerName" id="x<?php echo $tbl_dealer_list->RowIndex ?>_DealerName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_dealer->DealerName->getPlaceHolder()) ?>" value="<?php echo $tbl_dealer->DealerName->EditValue ?>"<?php echo $tbl_dealer->DealerName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_dealer->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_dealer_list->RowCnt ?>_tbl_dealer_DealerName" class="tbl_dealer_DealerName">
<span<?php echo $tbl_dealer->DealerName->viewAttributes() ?>>
<?php echo $tbl_dealer->DealerName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_dealer->RowType == ROWTYPE_EDIT || $tbl_dealer->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_dealer" data-field="x_ID_Dealer" name="x<?php echo $tbl_dealer_list->RowIndex ?>_ID_Dealer" id="x<?php echo $tbl_dealer_list->RowIndex ?>_ID_Dealer" value="<?php echo HtmlEncode($tbl_dealer->ID_Dealer->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_dealer->Address->Visible) { // Address ?>
		<td data-name="Address"<?php echo $tbl_dealer->Address->cellAttributes() ?>>
<?php if ($tbl_dealer->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_dealer_list->RowCnt ?>_tbl_dealer_Address" class="form-group tbl_dealer_Address">
<input type="text" data-table="tbl_dealer" data-field="x_Address" name="x<?php echo $tbl_dealer_list->RowIndex ?>_Address" id="x<?php echo $tbl_dealer_list->RowIndex ?>_Address" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_dealer->Address->getPlaceHolder()) ?>" value="<?php echo $tbl_dealer->Address->EditValue ?>"<?php echo $tbl_dealer->Address->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_dealer->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_dealer_list->RowCnt ?>_tbl_dealer_Address" class="tbl_dealer_Address">
<span<?php echo $tbl_dealer->Address->viewAttributes() ?>>
<?php echo $tbl_dealer->Address->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_dealer_list->ListOptions->render("body", "right", $tbl_dealer_list->RowCnt);
?>
	</tr>
<?php if ($tbl_dealer->RowType == ROWTYPE_ADD || $tbl_dealer->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_dealerlist.updateLists(<?php echo $tbl_dealer_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if (!$tbl_dealer->isGridAdd())
		$tbl_dealer_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_dealer->isAdd() || $tbl_dealer->isCopy()) { ?>
<input type="hidden" name="<?php echo $tbl_dealer_list->FormKeyCountName ?>" id="<?php echo $tbl_dealer_list->FormKeyCountName ?>" value="<?php echo $tbl_dealer_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_dealer->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_dealer_list->FormKeyCountName ?>" id="<?php echo $tbl_dealer_list->FormKeyCountName ?>" value="<?php echo $tbl_dealer_list->KeyCount ?>">
<?php } ?>
<?php if (!$tbl_dealer->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_dealer_list->Recordset)
	$tbl_dealer_list->Recordset->Close();
?>
<?php if (!$tbl_dealer->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_dealer->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_dealer_list->Pager)) $tbl_dealer_list->Pager = new PrevNextPager($tbl_dealer_list->StartRec, $tbl_dealer_list->DisplayRecs, $tbl_dealer_list->TotalRecs, $tbl_dealer_list->AutoHidePager) ?>
<?php if ($tbl_dealer_list->Pager->RecordCount > 0 && $tbl_dealer_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_dealer_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_dealer_list->pageUrl() ?>start=<?php echo $tbl_dealer_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_dealer_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_dealer_list->pageUrl() ?>start=<?php echo $tbl_dealer_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_dealer_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_dealer_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_dealer_list->pageUrl() ?>start=<?php echo $tbl_dealer_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_dealer_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_dealer_list->pageUrl() ?>start=<?php echo $tbl_dealer_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_dealer_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_dealer_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_dealer_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_dealer_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_dealer_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_dealer_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_dealer_list->TotalRecs == 0 && !$tbl_dealer->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_dealer_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_dealer_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_dealer->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_dealer_list->terminate();
?>