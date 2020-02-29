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
$tbl_contact_list = new tbl_contact_list();

// Run the page
$tbl_contact_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_contact_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_contact->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_contactlist = currentForm = new ew.Form("ftbl_contactlist", "list");
ftbl_contactlist.formKeyCountName = '<?php echo $tbl_contact_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_contactlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_contactlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_contactlist.lists["x_ContactType"] = <?php echo $tbl_contact_list->ContactType->Lookup->toClientList() ?>;
ftbl_contactlist.lists["x_ContactType"].options = <?php echo JsonEncode($tbl_contact_list->ContactType->options(FALSE, TRUE)) ?>;

// Form object for search
var ftbl_contactlistsrch = currentSearchForm = new ew.Form("ftbl_contactlistsrch");

// Filters
ftbl_contactlistsrch.filterList = <?php echo $tbl_contact_list->getFilterList() ?>;
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
<?php if (!$tbl_contact->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_contact_list->TotalRecs > 0 && $tbl_contact_list->ExportOptions->visible()) { ?>
<?php $tbl_contact_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_contact_list->ImportOptions->visible()) { ?>
<?php $tbl_contact_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_contact_list->SearchOptions->visible()) { ?>
<?php $tbl_contact_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_contact_list->FilterOptions->visible()) { ?>
<?php $tbl_contact_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_contact_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_contact->isExport() && !$tbl_contact->CurrentAction) { ?>
<form name="ftbl_contactlistsrch" id="ftbl_contactlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_contact_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_contactlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_contact">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_contact_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_contact_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_contact_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_contact_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_contact_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_contact_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_contact_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_contact_list->showPageHeader(); ?>
<?php
$tbl_contact_list->showMessage();
?>
<?php if ($tbl_contact_list->TotalRecs > 0 || $tbl_contact->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_contact_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_contact">
<?php if (!$tbl_contact->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_contact->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_contact_list->Pager)) $tbl_contact_list->Pager = new PrevNextPager($tbl_contact_list->StartRec, $tbl_contact_list->DisplayRecs, $tbl_contact_list->TotalRecs, $tbl_contact_list->AutoHidePager) ?>
<?php if ($tbl_contact_list->Pager->RecordCount > 0 && $tbl_contact_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_contact_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_contact_list->pageUrl() ?>start=<?php echo $tbl_contact_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_contact_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_contact_list->pageUrl() ?>start=<?php echo $tbl_contact_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_contact_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_contact_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_contact_list->pageUrl() ?>start=<?php echo $tbl_contact_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_contact_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_contact_list->pageUrl() ?>start=<?php echo $tbl_contact_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_contact_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_contact_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_contact_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_contact_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_contact_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_contact_list->TotalRecs > 0 && (!$tbl_contact_list->AutoHidePageSizeSelector || $tbl_contact_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_contact">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_contact_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_contact_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_contact_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_contact_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_contact_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_contact->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_contact_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_contactlist" id="ftbl_contactlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_contact_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_contact_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_contact">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_contact" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_contact_list->TotalRecs > 0 || $tbl_contact->isGridEdit()) { ?>
<table id="tbl_tbl_contactlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_contact_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_contact_list->renderListOptions();

// Render list options (header, left)
$tbl_contact_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_contact->CodeContact->Visible) { // CodeContact ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->CodeContact) == "") { ?>
		<th data-name="CodeContact" class="<?php echo $tbl_contact->CodeContact->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_CodeContact" class="tbl_contact_CodeContact"><div class="ew-table-header-caption"><?php echo $tbl_contact->CodeContact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CodeContact" class="<?php echo $tbl_contact->CodeContact->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->CodeContact) ?>',2);"><div id="elh_tbl_contact_CodeContact" class="tbl_contact_CodeContact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->CodeContact->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->CodeContact->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->CodeContact->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->ContactType->Visible) { // ContactType ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->ContactType) == "") { ?>
		<th data-name="ContactType" class="<?php echo $tbl_contact->ContactType->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_ContactType" class="tbl_contact_ContactType"><div class="ew-table-header-caption"><?php echo $tbl_contact->ContactType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactType" class="<?php echo $tbl_contact->ContactType->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->ContactType) ?>',2);"><div id="elh_tbl_contact_ContactType" class="tbl_contact_ContactType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->ContactType->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->ContactType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->ContactType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->ContactName->Visible) { // ContactName ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->ContactName) == "") { ?>
		<th data-name="ContactName" class="<?php echo $tbl_contact->ContactName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_ContactName" class="tbl_contact_ContactName"><div class="ew-table-header-caption"><?php echo $tbl_contact->ContactName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactName" class="<?php echo $tbl_contact->ContactName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->ContactName) ?>',2);"><div id="elh_tbl_contact_ContactName" class="tbl_contact_ContactName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->ContactName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->ContactName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->ContactName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->CompanyName->Visible) { // CompanyName ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $tbl_contact->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_CompanyName" class="tbl_contact_CompanyName"><div class="ew-table-header-caption"><?php echo $tbl_contact->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $tbl_contact->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->CompanyName) ?>',2);"><div id="elh_tbl_contact_CompanyName" class="tbl_contact_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->CompanyName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->CompanyName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->Address->Visible) { // Address ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $tbl_contact->Address->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_Address" class="tbl_contact_Address"><div class="ew-table-header-caption"><?php echo $tbl_contact->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $tbl_contact->Address->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->Address) ?>',2);"><div id="elh_tbl_contact_Address" class="tbl_contact_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->Address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->Address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->ContactPhone->Visible) { // ContactPhone ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->ContactPhone) == "") { ?>
		<th data-name="ContactPhone" class="<?php echo $tbl_contact->ContactPhone->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_ContactPhone" class="tbl_contact_ContactPhone"><div class="ew-table-header-caption"><?php echo $tbl_contact->ContactPhone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactPhone" class="<?php echo $tbl_contact->ContactPhone->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->ContactPhone) ?>',2);"><div id="elh_tbl_contact_ContactPhone" class="tbl_contact_ContactPhone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->ContactPhone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->ContactPhone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->ContactPhone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->ContactEmail->Visible) { // ContactEmail ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->ContactEmail) == "") { ?>
		<th data-name="ContactEmail" class="<?php echo $tbl_contact->ContactEmail->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_ContactEmail" class="tbl_contact_ContactEmail"><div class="ew-table-header-caption"><?php echo $tbl_contact->ContactEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactEmail" class="<?php echo $tbl_contact->ContactEmail->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->ContactEmail) ?>',2);"><div id="elh_tbl_contact_ContactEmail" class="tbl_contact_ContactEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->ContactEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->ContactEmail->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->ContactEmail->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->ReceiveName->Visible) { // ReceiveName ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->ReceiveName) == "") { ?>
		<th data-name="ReceiveName" class="<?php echo $tbl_contact->ReceiveName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_ReceiveName" class="tbl_contact_ReceiveName"><div class="ew-table-header-caption"><?php echo $tbl_contact->ReceiveName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiveName" class="<?php echo $tbl_contact->ReceiveName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->ReceiveName) ?>',2);"><div id="elh_tbl_contact_ReceiveName" class="tbl_contact_ReceiveName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->ReceiveName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->ReceiveName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->ReceiveName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->ReceiveTime->Visible) { // ReceiveTime ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->ReceiveTime) == "") { ?>
		<th data-name="ReceiveTime" class="<?php echo $tbl_contact->ReceiveTime->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_ReceiveTime" class="tbl_contact_ReceiveTime"><div class="ew-table-header-caption"><?php echo $tbl_contact->ReceiveTime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiveTime" class="<?php echo $tbl_contact->ReceiveTime->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->ReceiveTime) ?>',2);"><div id="elh_tbl_contact_ReceiveTime" class="tbl_contact_ReceiveTime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->ReceiveTime->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->ReceiveTime->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->ReceiveTime->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->Note->Visible) { // Note ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->Note) == "") { ?>
		<th data-name="Note" class="<?php echo $tbl_contact->Note->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_Note" class="tbl_contact_Note"><div class="ew-table-header-caption"><?php echo $tbl_contact->Note->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Note" class="<?php echo $tbl_contact->Note->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->Note) ?>',2);"><div id="elh_tbl_contact_Note" class="tbl_contact_Note">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->Note->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->Note->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->Note->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_contact->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_CreateUser" class="tbl_contact_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_contact->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_contact->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->CreateUser) ?>',2);"><div id="elh_tbl_contact_CreateUser" class="tbl_contact_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_contact->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_contact->sortUrl($tbl_contact->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_contact->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_contact_CreateDate" class="tbl_contact_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_contact->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_contact->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_contact->SortUrl($tbl_contact->CreateDate) ?>',2);"><div id="elh_tbl_contact_CreateDate" class="tbl_contact_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_contact->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_contact->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_contact->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_contact_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_contact->ExportAll && $tbl_contact->isExport()) {
	$tbl_contact_list->StopRec = $tbl_contact_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_contact_list->TotalRecs > $tbl_contact_list->StartRec + $tbl_contact_list->DisplayRecs - 1)
		$tbl_contact_list->StopRec = $tbl_contact_list->StartRec + $tbl_contact_list->DisplayRecs - 1;
	else
		$tbl_contact_list->StopRec = $tbl_contact_list->TotalRecs;
}
$tbl_contact_list->RecCnt = $tbl_contact_list->StartRec - 1;
if ($tbl_contact_list->Recordset && !$tbl_contact_list->Recordset->EOF) {
	$tbl_contact_list->Recordset->moveFirst();
	$selectLimit = $tbl_contact_list->UseSelectLimit;
	if (!$selectLimit && $tbl_contact_list->StartRec > 1)
		$tbl_contact_list->Recordset->move($tbl_contact_list->StartRec - 1);
} elseif (!$tbl_contact->AllowAddDeleteRow && $tbl_contact_list->StopRec == 0) {
	$tbl_contact_list->StopRec = $tbl_contact->GridAddRowCount;
}

// Initialize aggregate
$tbl_contact->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_contact->resetAttributes();
$tbl_contact_list->renderRow();
while ($tbl_contact_list->RecCnt < $tbl_contact_list->StopRec) {
	$tbl_contact_list->RecCnt++;
	if ($tbl_contact_list->RecCnt >= $tbl_contact_list->StartRec) {
		$tbl_contact_list->RowCnt++;

		// Set up key count
		$tbl_contact_list->KeyCount = $tbl_contact_list->RowIndex;

		// Init row class and style
		$tbl_contact->resetAttributes();
		$tbl_contact->CssClass = "";
		if ($tbl_contact->isGridAdd()) {
		} else {
			$tbl_contact_list->loadRowValues($tbl_contact_list->Recordset); // Load row values
		}
		$tbl_contact->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_contact->RowAttrs = array_merge($tbl_contact->RowAttrs, array('data-rowindex'=>$tbl_contact_list->RowCnt, 'id'=>'r' . $tbl_contact_list->RowCnt . '_tbl_contact', 'data-rowtype'=>$tbl_contact->RowType));

		// Render row
		$tbl_contact_list->renderRow();

		// Render list options
		$tbl_contact_list->renderListOptions();
?>
	<tr<?php echo $tbl_contact->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_contact_list->ListOptions->render("body", "left", $tbl_contact_list->RowCnt);
?>
	<?php if ($tbl_contact->CodeContact->Visible) { // CodeContact ?>
		<td data-name="CodeContact"<?php echo $tbl_contact->CodeContact->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_CodeContact" class="tbl_contact_CodeContact">
<span<?php echo $tbl_contact->CodeContact->viewAttributes() ?>>
<?php echo $tbl_contact->CodeContact->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->ContactType->Visible) { // ContactType ?>
		<td data-name="ContactType"<?php echo $tbl_contact->ContactType->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_ContactType" class="tbl_contact_ContactType">
<span<?php echo $tbl_contact->ContactType->viewAttributes() ?>>
<?php echo $tbl_contact->ContactType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName"<?php echo $tbl_contact->ContactName->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_ContactName" class="tbl_contact_ContactName">
<span<?php echo $tbl_contact->ContactName->viewAttributes() ?>>
<?php echo $tbl_contact->ContactName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName"<?php echo $tbl_contact->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_CompanyName" class="tbl_contact_CompanyName">
<span<?php echo $tbl_contact->CompanyName->viewAttributes() ?>>
<?php echo $tbl_contact->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->Address->Visible) { // Address ?>
		<td data-name="Address"<?php echo $tbl_contact->Address->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_Address" class="tbl_contact_Address">
<span<?php echo $tbl_contact->Address->viewAttributes() ?>>
<?php echo $tbl_contact->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->ContactPhone->Visible) { // ContactPhone ?>
		<td data-name="ContactPhone"<?php echo $tbl_contact->ContactPhone->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_ContactPhone" class="tbl_contact_ContactPhone">
<span<?php echo $tbl_contact->ContactPhone->viewAttributes() ?>>
<?php echo $tbl_contact->ContactPhone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->ContactEmail->Visible) { // ContactEmail ?>
		<td data-name="ContactEmail"<?php echo $tbl_contact->ContactEmail->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_ContactEmail" class="tbl_contact_ContactEmail">
<span<?php echo $tbl_contact->ContactEmail->viewAttributes() ?>>
<?php echo $tbl_contact->ContactEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->ReceiveName->Visible) { // ReceiveName ?>
		<td data-name="ReceiveName"<?php echo $tbl_contact->ReceiveName->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_ReceiveName" class="tbl_contact_ReceiveName">
<span<?php echo $tbl_contact->ReceiveName->viewAttributes() ?>>
<?php echo $tbl_contact->ReceiveName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->ReceiveTime->Visible) { // ReceiveTime ?>
		<td data-name="ReceiveTime"<?php echo $tbl_contact->ReceiveTime->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_ReceiveTime" class="tbl_contact_ReceiveTime">
<span<?php echo $tbl_contact->ReceiveTime->viewAttributes() ?>>
<?php echo $tbl_contact->ReceiveTime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->Note->Visible) { // Note ?>
		<td data-name="Note"<?php echo $tbl_contact->Note->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_Note" class="tbl_contact_Note">
<span<?php echo $tbl_contact->Note->viewAttributes() ?>>
<?php echo $tbl_contact->Note->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_contact->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_CreateUser" class="tbl_contact_CreateUser">
<span<?php echo $tbl_contact->CreateUser->viewAttributes() ?>>
<?php echo $tbl_contact->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_contact->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_contact->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_list->RowCnt ?>_tbl_contact_CreateDate" class="tbl_contact_CreateDate">
<span<?php echo $tbl_contact->CreateDate->viewAttributes() ?>>
<?php echo $tbl_contact->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_contact_list->ListOptions->render("body", "right", $tbl_contact_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_contact->isGridAdd())
		$tbl_contact_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_contact->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_contact_list->Recordset)
	$tbl_contact_list->Recordset->Close();
?>
<?php if (!$tbl_contact->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_contact->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_contact_list->Pager)) $tbl_contact_list->Pager = new PrevNextPager($tbl_contact_list->StartRec, $tbl_contact_list->DisplayRecs, $tbl_contact_list->TotalRecs, $tbl_contact_list->AutoHidePager) ?>
<?php if ($tbl_contact_list->Pager->RecordCount > 0 && $tbl_contact_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_contact_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_contact_list->pageUrl() ?>start=<?php echo $tbl_contact_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_contact_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_contact_list->pageUrl() ?>start=<?php echo $tbl_contact_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_contact_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_contact_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_contact_list->pageUrl() ?>start=<?php echo $tbl_contact_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_contact_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_contact_list->pageUrl() ?>start=<?php echo $tbl_contact_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_contact_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_contact_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_contact_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_contact_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_contact_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_contact_list->TotalRecs > 0 && (!$tbl_contact_list->AutoHidePageSizeSelector || $tbl_contact_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_contact">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_contact_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_contact_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_contact_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_contact_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_contact_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_contact->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_contact_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_contact_list->TotalRecs == 0 && !$tbl_contact->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_contact_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_contact_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_contact->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php if (!$tbl_contact->isExport()) { ?>
<script>
ew.scrollableTable("gmp_tbl_contact", "100%", "500px");
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_contact_list->terminate();
?>