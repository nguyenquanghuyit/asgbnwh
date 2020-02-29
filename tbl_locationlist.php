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
$tbl_location_list = new tbl_location_list();

// Run the page
$tbl_location_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_location_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_location->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_locationlist = currentForm = new ew.Form("ftbl_locationlist", "list");
ftbl_locationlist.formKeyCountName = '<?php echo $tbl_location_list->FormKeyCountName ?>';

// Validate form
ftbl_locationlist.validate = function() {
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
		<?php if ($tbl_location_list->Location->Required) { ?>
			elm = this.getElements("x" + infix + "_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_location->Location->caption(), $tbl_location->Location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_location_list->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_location->Description->caption(), $tbl_location->Description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_location_list->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_location->CreateUser->caption(), $tbl_location->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_location_list->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_location->CreateDate->caption(), $tbl_location->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_location_list->UpdateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_location->UpdateUser->caption(), $tbl_location->UpdateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_location_list->UpdateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_location->UpdateDate->caption(), $tbl_location->UpdateDate->RequiredErrorMessage)) ?>");
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
ftbl_locationlist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Location", false)) return false;
	if (ew.valueChanged(fobj, infix, "Description", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_locationlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_locationlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftbl_locationlistsrch = currentSearchForm = new ew.Form("ftbl_locationlistsrch");

// Filters
ftbl_locationlistsrch.filterList = <?php echo $tbl_location_list->getFilterList() ?>;
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
<?php if (!$tbl_location->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_location_list->TotalRecs > 0 && $tbl_location_list->ExportOptions->visible()) { ?>
<?php $tbl_location_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_location_list->ImportOptions->visible()) { ?>
<?php $tbl_location_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_location_list->SearchOptions->visible()) { ?>
<?php $tbl_location_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_location_list->FilterOptions->visible()) { ?>
<?php $tbl_location_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_location_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_location->isExport() && !$tbl_location->CurrentAction) { ?>
<form name="ftbl_locationlistsrch" id="ftbl_locationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_location_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_locationlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_location">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_location_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_location_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_location_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_location_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_location_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_location_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_location_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_location_list->showPageHeader(); ?>
<?php
$tbl_location_list->showMessage();
?>
<?php if ($tbl_location_list->TotalRecs > 0 || $tbl_location->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_location_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_location">
<?php if (!$tbl_location->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_location->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_location_list->Pager)) $tbl_location_list->Pager = new PrevNextPager($tbl_location_list->StartRec, $tbl_location_list->DisplayRecs, $tbl_location_list->TotalRecs, $tbl_location_list->AutoHidePager) ?>
<?php if ($tbl_location_list->Pager->RecordCount > 0 && $tbl_location_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_location_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_location_list->pageUrl() ?>start=<?php echo $tbl_location_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_location_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_location_list->pageUrl() ?>start=<?php echo $tbl_location_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_location_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_location_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_location_list->pageUrl() ?>start=<?php echo $tbl_location_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_location_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_location_list->pageUrl() ?>start=<?php echo $tbl_location_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_location_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_location_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_location_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_location_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_location_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_location_list->TotalRecs > 0 && (!$tbl_location_list->AutoHidePageSizeSelector || $tbl_location_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_location">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_location_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_location_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_location_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_location_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_location_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_location->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_location_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_locationlist" id="ftbl_locationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_location_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_location_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_location">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_location" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_location_list->TotalRecs > 0 || $tbl_location->isAdd() || $tbl_location->isCopy() || $tbl_location->isGridEdit()) { ?>
<table id="tbl_tbl_locationlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_location_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_location_list->renderListOptions();

// Render list options (header, left)
$tbl_location_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_location->Location->Visible) { // Location ?>
	<?php if ($tbl_location->sortUrl($tbl_location->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $tbl_location->Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_location_Location" class="tbl_location_Location"><div class="ew-table-header-caption"><?php echo $tbl_location->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $tbl_location->Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_location->SortUrl($tbl_location->Location) ?>',2);"><div id="elh_tbl_location_Location" class="tbl_location_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_location->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_location->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_location->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_location->Description->Visible) { // Description ?>
	<?php if ($tbl_location->sortUrl($tbl_location->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $tbl_location->Description->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_location_Description" class="tbl_location_Description"><div class="ew-table-header-caption"><?php echo $tbl_location->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $tbl_location->Description->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_location->SortUrl($tbl_location->Description) ?>',2);"><div id="elh_tbl_location_Description" class="tbl_location_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_location->Description->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_location->Description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_location->Description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_location->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_location->sortUrl($tbl_location->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_location->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_location_CreateUser" class="tbl_location_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_location->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_location->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_location->SortUrl($tbl_location->CreateUser) ?>',2);"><div id="elh_tbl_location_CreateUser" class="tbl_location_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_location->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_location->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_location->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_location->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_location->sortUrl($tbl_location->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_location->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_location_CreateDate" class="tbl_location_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_location->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_location->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_location->SortUrl($tbl_location->CreateDate) ?>',2);"><div id="elh_tbl_location_CreateDate" class="tbl_location_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_location->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_location->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_location->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_location->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($tbl_location->sortUrl($tbl_location->UpdateUser) == "") { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_location->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_location_UpdateUser" class="tbl_location_UpdateUser"><div class="ew-table-header-caption"><?php echo $tbl_location->UpdateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_location->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_location->SortUrl($tbl_location->UpdateUser) ?>',2);"><div id="elh_tbl_location_UpdateUser" class="tbl_location_UpdateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_location->UpdateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_location->UpdateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_location->UpdateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_location->UpdateDate->Visible) { // UpdateDate ?>
	<?php if ($tbl_location->sortUrl($tbl_location->UpdateDate) == "") { ?>
		<th data-name="UpdateDate" class="<?php echo $tbl_location->UpdateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_location_UpdateDate" class="tbl_location_UpdateDate"><div class="ew-table-header-caption"><?php echo $tbl_location->UpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateDate" class="<?php echo $tbl_location->UpdateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_location->SortUrl($tbl_location->UpdateDate) ?>',2);"><div id="elh_tbl_location_UpdateDate" class="tbl_location_UpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_location->UpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_location->UpdateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_location->UpdateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_location_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($tbl_location->isAdd() || $tbl_location->isCopy()) {
		$tbl_location_list->RowIndex = 0;
		$tbl_location_list->KeyCount = $tbl_location_list->RowIndex;
		if ($tbl_location->isAdd())
			$tbl_location_list->loadRowValues();
		if ($tbl_location->EventCancelled) // Insert failed
			$tbl_location_list->restoreFormValues(); // Restore form values

		// Set row properties
		$tbl_location->resetAttributes();
		$tbl_location->RowAttrs = array_merge($tbl_location->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_tbl_location', 'data-rowtype'=>ROWTYPE_ADD));
		$tbl_location->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_location_list->renderRow();

		// Render list options
		$tbl_location_list->renderListOptions();
		$tbl_location_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_location->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_location_list->ListOptions->render("body", "left", $tbl_location_list->RowCnt);
?>
	<?php if ($tbl_location->Location->Visible) { // Location ?>
		<td data-name="Location">
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_Location" class="form-group tbl_location_Location">
<input type="text" data-table="tbl_location" data-field="x_Location" name="x<?php echo $tbl_location_list->RowIndex ?>_Location" id="x<?php echo $tbl_location_list->RowIndex ?>_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_location->Location->getPlaceHolder()) ?>" value="<?php echo $tbl_location->Location->EditValue ?>"<?php echo $tbl_location->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_location" data-field="x_Location" name="o<?php echo $tbl_location_list->RowIndex ?>_Location" id="o<?php echo $tbl_location_list->RowIndex ?>_Location" value="<?php echo HtmlEncode($tbl_location->Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_location->Description->Visible) { // Description ?>
		<td data-name="Description">
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_Description" class="form-group tbl_location_Description">
<input type="text" data-table="tbl_location" data-field="x_Description" name="x<?php echo $tbl_location_list->RowIndex ?>_Description" id="x<?php echo $tbl_location_list->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_location->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_location->Description->EditValue ?>"<?php echo $tbl_location->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_location" data-field="x_Description" name="o<?php echo $tbl_location_list->RowIndex ?>_Description" id="o<?php echo $tbl_location_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_location->Description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_location->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<input type="hidden" data-table="tbl_location" data-field="x_CreateUser" name="o<?php echo $tbl_location_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_location_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_location->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_location->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<input type="hidden" data-table="tbl_location" data-field="x_CreateDate" name="o<?php echo $tbl_location_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_location_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_location->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_location->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser">
<input type="hidden" data-table="tbl_location" data-field="x_UpdateUser" name="o<?php echo $tbl_location_list->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_location_list->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_location->UpdateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_location->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate">
<input type="hidden" data-table="tbl_location" data-field="x_UpdateDate" name="o<?php echo $tbl_location_list->RowIndex ?>_UpdateDate" id="o<?php echo $tbl_location_list->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_location->UpdateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_location_list->ListOptions->render("body", "right", $tbl_location_list->RowCnt);
?>
<script>
ftbl_locationlist.updateLists(<?php echo $tbl_location_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($tbl_location->ExportAll && $tbl_location->isExport()) {
	$tbl_location_list->StopRec = $tbl_location_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_location_list->TotalRecs > $tbl_location_list->StartRec + $tbl_location_list->DisplayRecs - 1)
		$tbl_location_list->StopRec = $tbl_location_list->StartRec + $tbl_location_list->DisplayRecs - 1;
	else
		$tbl_location_list->StopRec = $tbl_location_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_location_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_location_list->FormKeyCountName) && ($tbl_location->isGridAdd() || $tbl_location->isGridEdit() || $tbl_location->isConfirm())) {
		$tbl_location_list->KeyCount = $CurrentForm->getValue($tbl_location_list->FormKeyCountName);
		$tbl_location_list->StopRec = $tbl_location_list->StartRec + $tbl_location_list->KeyCount - 1;
	}
}
$tbl_location_list->RecCnt = $tbl_location_list->StartRec - 1;
if ($tbl_location_list->Recordset && !$tbl_location_list->Recordset->EOF) {
	$tbl_location_list->Recordset->moveFirst();
	$selectLimit = $tbl_location_list->UseSelectLimit;
	if (!$selectLimit && $tbl_location_list->StartRec > 1)
		$tbl_location_list->Recordset->move($tbl_location_list->StartRec - 1);
} elseif (!$tbl_location->AllowAddDeleteRow && $tbl_location_list->StopRec == 0) {
	$tbl_location_list->StopRec = $tbl_location->GridAddRowCount;
}

// Initialize aggregate
$tbl_location->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_location->resetAttributes();
$tbl_location_list->renderRow();
$tbl_location_list->EditRowCnt = 0;
if ($tbl_location->isEdit())
	$tbl_location_list->RowIndex = 1;
if ($tbl_location->isGridAdd())
	$tbl_location_list->RowIndex = 0;
if ($tbl_location->isGridEdit())
	$tbl_location_list->RowIndex = 0;
while ($tbl_location_list->RecCnt < $tbl_location_list->StopRec) {
	$tbl_location_list->RecCnt++;
	if ($tbl_location_list->RecCnt >= $tbl_location_list->StartRec) {
		$tbl_location_list->RowCnt++;
		if ($tbl_location->isGridAdd() || $tbl_location->isGridEdit() || $tbl_location->isConfirm()) {
			$tbl_location_list->RowIndex++;
			$CurrentForm->Index = $tbl_location_list->RowIndex;
			if ($CurrentForm->hasValue($tbl_location_list->FormActionName) && $tbl_location_list->EventCancelled)
				$tbl_location_list->RowAction = strval($CurrentForm->getValue($tbl_location_list->FormActionName));
			elseif ($tbl_location->isGridAdd())
				$tbl_location_list->RowAction = "insert";
			else
				$tbl_location_list->RowAction = "";
		}

		// Set up key count
		$tbl_location_list->KeyCount = $tbl_location_list->RowIndex;

		// Init row class and style
		$tbl_location->resetAttributes();
		$tbl_location->CssClass = "";
		if ($tbl_location->isGridAdd()) {
			$tbl_location_list->loadRowValues(); // Load default values
		} else {
			$tbl_location_list->loadRowValues($tbl_location_list->Recordset); // Load row values
		}
		$tbl_location->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_location->isGridAdd()) // Grid add
			$tbl_location->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_location->isGridAdd() && $tbl_location->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_location_list->restoreCurrentRowFormValues($tbl_location_list->RowIndex); // Restore form values
		if ($tbl_location->isEdit()) {
			if ($tbl_location_list->checkInlineEditKey() && $tbl_location_list->EditRowCnt == 0) { // Inline edit
				$tbl_location->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_location->isGridEdit()) { // Grid edit
			if ($tbl_location->EventCancelled)
				$tbl_location_list->restoreCurrentRowFormValues($tbl_location_list->RowIndex); // Restore form values
			if ($tbl_location_list->RowAction == "insert")
				$tbl_location->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_location->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_location->isEdit() && $tbl_location->RowType == ROWTYPE_EDIT && $tbl_location->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_location_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_location->isGridEdit() && ($tbl_location->RowType == ROWTYPE_EDIT || $tbl_location->RowType == ROWTYPE_ADD) && $tbl_location->EventCancelled) // Update failed
			$tbl_location_list->restoreCurrentRowFormValues($tbl_location_list->RowIndex); // Restore form values
		if ($tbl_location->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_location_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_location->RowAttrs = array_merge($tbl_location->RowAttrs, array('data-rowindex'=>$tbl_location_list->RowCnt, 'id'=>'r' . $tbl_location_list->RowCnt . '_tbl_location', 'data-rowtype'=>$tbl_location->RowType));

		// Render row
		$tbl_location_list->renderRow();

		// Render list options
		$tbl_location_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_location_list->RowAction <> "delete" && $tbl_location_list->RowAction <> "insertdelete" && !($tbl_location_list->RowAction == "insert" && $tbl_location->isConfirm() && $tbl_location_list->emptyRow())) {
?>
	<tr<?php echo $tbl_location->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_location_list->ListOptions->render("body", "left", $tbl_location_list->RowCnt);
?>
	<?php if ($tbl_location->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $tbl_location->Location->cellAttributes() ?>>
<?php if ($tbl_location->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_Location" class="form-group tbl_location_Location">
<input type="text" data-table="tbl_location" data-field="x_Location" name="x<?php echo $tbl_location_list->RowIndex ?>_Location" id="x<?php echo $tbl_location_list->RowIndex ?>_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_location->Location->getPlaceHolder()) ?>" value="<?php echo $tbl_location->Location->EditValue ?>"<?php echo $tbl_location->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_location" data-field="x_Location" name="o<?php echo $tbl_location_list->RowIndex ?>_Location" id="o<?php echo $tbl_location_list->RowIndex ?>_Location" value="<?php echo HtmlEncode($tbl_location->Location->OldValue) ?>">
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_Location" class="form-group tbl_location_Location">
<input type="text" data-table="tbl_location" data-field="x_Location" name="x<?php echo $tbl_location_list->RowIndex ?>_Location" id="x<?php echo $tbl_location_list->RowIndex ?>_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_location->Location->getPlaceHolder()) ?>" value="<?php echo $tbl_location->Location->EditValue ?>"<?php echo $tbl_location->Location->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_Location" class="tbl_location_Location">
<span<?php echo $tbl_location->Location->viewAttributes() ?>>
<?php echo $tbl_location->Location->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_location" data-field="x_ID_Location" name="x<?php echo $tbl_location_list->RowIndex ?>_ID_Location" id="x<?php echo $tbl_location_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_location->ID_Location->CurrentValue) ?>">
<input type="hidden" data-table="tbl_location" data-field="x_ID_Location" name="o<?php echo $tbl_location_list->RowIndex ?>_ID_Location" id="o<?php echo $tbl_location_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_location->ID_Location->OldValue) ?>">
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_EDIT || $tbl_location->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_location" data-field="x_ID_Location" name="x<?php echo $tbl_location_list->RowIndex ?>_ID_Location" id="x<?php echo $tbl_location_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_location->ID_Location->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_location->Description->Visible) { // Description ?>
		<td data-name="Description"<?php echo $tbl_location->Description->cellAttributes() ?>>
<?php if ($tbl_location->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_Description" class="form-group tbl_location_Description">
<input type="text" data-table="tbl_location" data-field="x_Description" name="x<?php echo $tbl_location_list->RowIndex ?>_Description" id="x<?php echo $tbl_location_list->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_location->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_location->Description->EditValue ?>"<?php echo $tbl_location->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_location" data-field="x_Description" name="o<?php echo $tbl_location_list->RowIndex ?>_Description" id="o<?php echo $tbl_location_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_location->Description->OldValue) ?>">
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_Description" class="form-group tbl_location_Description">
<input type="text" data-table="tbl_location" data-field="x_Description" name="x<?php echo $tbl_location_list->RowIndex ?>_Description" id="x<?php echo $tbl_location_list->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_location->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_location->Description->EditValue ?>"<?php echo $tbl_location->Description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_Description" class="tbl_location_Description">
<span<?php echo $tbl_location->Description->viewAttributes() ?>>
<?php echo $tbl_location->Description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_location->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_location->CreateUser->cellAttributes() ?>>
<?php if ($tbl_location->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_location" data-field="x_CreateUser" name="o<?php echo $tbl_location_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_location_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_location->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_CreateUser" class="tbl_location_CreateUser">
<span<?php echo $tbl_location->CreateUser->viewAttributes() ?>>
<?php echo $tbl_location->CreateUser->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_location->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_location->CreateDate->cellAttributes() ?>>
<?php if ($tbl_location->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_location" data-field="x_CreateDate" name="o<?php echo $tbl_location_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_location_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_location->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_CreateDate" class="tbl_location_CreateDate">
<span<?php echo $tbl_location->CreateDate->viewAttributes() ?>>
<?php echo $tbl_location->CreateDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_location->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser"<?php echo $tbl_location->UpdateUser->cellAttributes() ?>>
<?php if ($tbl_location->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_location" data-field="x_UpdateUser" name="o<?php echo $tbl_location_list->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_location_list->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_location->UpdateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_UpdateUser" class="tbl_location_UpdateUser">
<span<?php echo $tbl_location->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_location->UpdateUser->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_location->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate"<?php echo $tbl_location->UpdateDate->cellAttributes() ?>>
<?php if ($tbl_location->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_location" data-field="x_UpdateDate" name="o<?php echo $tbl_location_list->RowIndex ?>_UpdateDate" id="o<?php echo $tbl_location_list->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_location->UpdateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_location->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_location_list->RowCnt ?>_tbl_location_UpdateDate" class="tbl_location_UpdateDate">
<span<?php echo $tbl_location->UpdateDate->viewAttributes() ?>>
<?php echo $tbl_location->UpdateDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_location_list->ListOptions->render("body", "right", $tbl_location_list->RowCnt);
?>
	</tr>
<?php if ($tbl_location->RowType == ROWTYPE_ADD || $tbl_location->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_locationlist.updateLists(<?php echo $tbl_location_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_location->isGridAdd())
		if (!$tbl_location_list->Recordset->EOF)
			$tbl_location_list->Recordset->moveNext();
}
?>
<?php
	if ($tbl_location->isGridAdd() || $tbl_location->isGridEdit()) {
		$tbl_location_list->RowIndex = '$rowindex$';
		$tbl_location_list->loadRowValues();

		// Set row properties
		$tbl_location->resetAttributes();
		$tbl_location->RowAttrs = array_merge($tbl_location->RowAttrs, array('data-rowindex'=>$tbl_location_list->RowIndex, 'id'=>'r0_tbl_location', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_location->RowAttrs["class"], "ew-template");
		$tbl_location->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_location_list->renderRow();

		// Render list options
		$tbl_location_list->renderListOptions();
		$tbl_location_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_location->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_location_list->ListOptions->render("body", "left", $tbl_location_list->RowIndex);
?>
	<?php if ($tbl_location->Location->Visible) { // Location ?>
		<td data-name="Location">
<span id="el$rowindex$_tbl_location_Location" class="form-group tbl_location_Location">
<input type="text" data-table="tbl_location" data-field="x_Location" name="x<?php echo $tbl_location_list->RowIndex ?>_Location" id="x<?php echo $tbl_location_list->RowIndex ?>_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_location->Location->getPlaceHolder()) ?>" value="<?php echo $tbl_location->Location->EditValue ?>"<?php echo $tbl_location->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_location" data-field="x_Location" name="o<?php echo $tbl_location_list->RowIndex ?>_Location" id="o<?php echo $tbl_location_list->RowIndex ?>_Location" value="<?php echo HtmlEncode($tbl_location->Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_location->Description->Visible) { // Description ?>
		<td data-name="Description">
<span id="el$rowindex$_tbl_location_Description" class="form-group tbl_location_Description">
<input type="text" data-table="tbl_location" data-field="x_Description" name="x<?php echo $tbl_location_list->RowIndex ?>_Description" id="x<?php echo $tbl_location_list->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_location->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_location->Description->EditValue ?>"<?php echo $tbl_location->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_location" data-field="x_Description" name="o<?php echo $tbl_location_list->RowIndex ?>_Description" id="o<?php echo $tbl_location_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_location->Description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_location->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<input type="hidden" data-table="tbl_location" data-field="x_CreateUser" name="o<?php echo $tbl_location_list->RowIndex ?>_CreateUser" id="o<?php echo $tbl_location_list->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_location->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_location->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<input type="hidden" data-table="tbl_location" data-field="x_CreateDate" name="o<?php echo $tbl_location_list->RowIndex ?>_CreateDate" id="o<?php echo $tbl_location_list->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_location->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_location->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser">
<input type="hidden" data-table="tbl_location" data-field="x_UpdateUser" name="o<?php echo $tbl_location_list->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_location_list->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_location->UpdateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_location->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate">
<input type="hidden" data-table="tbl_location" data-field="x_UpdateDate" name="o<?php echo $tbl_location_list->RowIndex ?>_UpdateDate" id="o<?php echo $tbl_location_list->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_location->UpdateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_location_list->ListOptions->render("body", "right", $tbl_location_list->RowIndex);
?>
<script>
ftbl_locationlist.updateLists(<?php echo $tbl_location_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_location->isAdd() || $tbl_location->isCopy()) { ?>
<input type="hidden" name="<?php echo $tbl_location_list->FormKeyCountName ?>" id="<?php echo $tbl_location_list->FormKeyCountName ?>" value="<?php echo $tbl_location_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_location->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $tbl_location_list->FormKeyCountName ?>" id="<?php echo $tbl_location_list->FormKeyCountName ?>" value="<?php echo $tbl_location_list->KeyCount ?>">
<?php echo $tbl_location_list->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_location->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_location_list->FormKeyCountName ?>" id="<?php echo $tbl_location_list->FormKeyCountName ?>" value="<?php echo $tbl_location_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_location->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $tbl_location_list->FormKeyCountName ?>" id="<?php echo $tbl_location_list->FormKeyCountName ?>" value="<?php echo $tbl_location_list->KeyCount ?>">
<?php echo $tbl_location_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$tbl_location->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_location_list->Recordset)
	$tbl_location_list->Recordset->Close();
?>
<?php if (!$tbl_location->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_location->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_location_list->Pager)) $tbl_location_list->Pager = new PrevNextPager($tbl_location_list->StartRec, $tbl_location_list->DisplayRecs, $tbl_location_list->TotalRecs, $tbl_location_list->AutoHidePager) ?>
<?php if ($tbl_location_list->Pager->RecordCount > 0 && $tbl_location_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_location_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_location_list->pageUrl() ?>start=<?php echo $tbl_location_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_location_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_location_list->pageUrl() ?>start=<?php echo $tbl_location_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_location_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_location_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_location_list->pageUrl() ?>start=<?php echo $tbl_location_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_location_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_location_list->pageUrl() ?>start=<?php echo $tbl_location_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_location_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_location_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_location_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_location_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_location_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_location_list->TotalRecs > 0 && (!$tbl_location_list->AutoHidePageSizeSelector || $tbl_location_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_location">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_location_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_location_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_location_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_location_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_location_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_location->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_location_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_location_list->TotalRecs == 0 && !$tbl_location->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_location_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_location_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_location->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_location_list->terminate();
?>