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
WriteHeader(FALSE, "utf-8");

// Create page object
$tbl_unload_preview = new tbl_unload_preview();

// Run the page
$tbl_unload_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unload_preview->Page_Render();
?>
<?php $tbl_unload_preview->showPageHeader(); ?>
<div class="card ew-grid tbl_unload"><!-- .card -->
<?php if ($tbl_unload_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$tbl_unload_preview->renderListOptions();

// Render list options (header, left)
$tbl_unload_preview->ListOptions->render("header", "left");
?>
<?php if ($tbl_unload->Code->Visible) { // Code ?>
	<?php if ($tbl_unload->SortUrl($tbl_unload->Code) == "") { ?>
		<th class="<?php echo $tbl_unload->Code->headerCellClass() ?>"><?php echo $tbl_unload->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unload->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_unload->Code->Name ?>" data-sort-order="<?php echo $tbl_unload_preview->SortField == $tbl_unload->Code->Name && $tbl_unload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_unload->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_unload_preview->SortField == $tbl_unload->Code->Name) { ?><?php if ($tbl_unload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_unload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
	<?php if ($tbl_unload->SortUrl($tbl_unload->IdCode) == "") { ?>
		<th class="<?php echo $tbl_unload->IdCode->headerCellClass() ?>"><?php echo $tbl_unload->IdCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unload->IdCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_unload->IdCode->Name ?>" data-sort-order="<?php echo $tbl_unload_preview->SortField == $tbl_unload->IdCode->Name && $tbl_unload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_unload->IdCode->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_unload_preview->SortField == $tbl_unload->IdCode->Name) { ?><?php if ($tbl_unload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_unload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
	<?php if ($tbl_unload->SortUrl($tbl_unload->PCS) == "") { ?>
		<th class="<?php echo $tbl_unload->PCS->headerCellClass() ?>"><?php echo $tbl_unload->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unload->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_unload->PCS->Name ?>" data-sort-order="<?php echo $tbl_unload_preview->SortField == $tbl_unload->PCS->Name && $tbl_unload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_unload->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_unload_preview->SortField == $tbl_unload->PCS->Name) { ?><?php if ($tbl_unload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_unload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
	<?php if ($tbl_unload->SortUrl($tbl_unload->RealPCS) == "") { ?>
		<th class="<?php echo $tbl_unload->RealPCS->headerCellClass() ?>"><?php echo $tbl_unload->RealPCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unload->RealPCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_unload->RealPCS->Name ?>" data-sort-order="<?php echo $tbl_unload_preview->SortField == $tbl_unload->RealPCS->Name && $tbl_unload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_unload->RealPCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_unload_preview->SortField == $tbl_unload->RealPCS->Name) { ?><?php if ($tbl_unload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_unload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->Description->Visible) { // Description ?>
	<?php if ($tbl_unload->SortUrl($tbl_unload->Description) == "") { ?>
		<th class="<?php echo $tbl_unload->Description->headerCellClass() ?>"><?php echo $tbl_unload->Description->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unload->Description->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_unload->Description->Name ?>" data-sort-order="<?php echo $tbl_unload_preview->SortField == $tbl_unload->Description->Name && $tbl_unload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_unload->Description->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_unload_preview->SortField == $tbl_unload->Description->Name) { ?><?php if ($tbl_unload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_unload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_unload->SortUrl($tbl_unload->CreateUser) == "") { ?>
		<th class="<?php echo $tbl_unload->CreateUser->headerCellClass() ?>"><?php echo $tbl_unload->CreateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unload->CreateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_unload->CreateUser->Name ?>" data-sort-order="<?php echo $tbl_unload_preview->SortField == $tbl_unload->CreateUser->Name && $tbl_unload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_unload->CreateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_unload_preview->SortField == $tbl_unload->CreateUser->Name) { ?><?php if ($tbl_unload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_unload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_unload->SortUrl($tbl_unload->CreateDate) == "") { ?>
		<th class="<?php echo $tbl_unload->CreateDate->headerCellClass() ?>"><?php echo $tbl_unload->CreateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unload->CreateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_unload->CreateDate->Name ?>" data-sort-order="<?php echo $tbl_unload_preview->SortField == $tbl_unload->CreateDate->Name && $tbl_unload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_unload->CreateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_unload_preview->SortField == $tbl_unload->CreateDate->Name) { ?><?php if ($tbl_unload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_unload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
	<?php if ($tbl_unload->SortUrl($tbl_unload->MFG) == "") { ?>
		<th class="<?php echo $tbl_unload->MFG->headerCellClass() ?>"><?php echo $tbl_unload->MFG->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_unload->MFG->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_unload->MFG->Name ?>" data-sort-order="<?php echo $tbl_unload_preview->SortField == $tbl_unload->MFG->Name && $tbl_unload_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_unload->MFG->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_unload_preview->SortField == $tbl_unload->MFG->Name) { ?><?php if ($tbl_unload_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_unload_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_unload_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_unload_preview->RecCount = 0;
$tbl_unload_preview->RowCnt = 0;
while ($tbl_unload_preview->Recordset && !$tbl_unload_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_unload_preview->RecCount++;
	$tbl_unload_preview->RowCnt++;
	$tbl_unload_preview->CssStyle = "";
	$tbl_unload_preview->loadListRowValues($tbl_unload_preview->Recordset);
	$tbl_unload_preview->aggregateListRowValues(); // Aggregate row values

	// Render row
	$tbl_unload_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$tbl_unload_preview->resetAttributes();
	$tbl_unload_preview->renderListRow();

	// Render list options
	$tbl_unload_preview->renderListOptions();
?>
	<tr<?php echo $tbl_unload_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_unload_preview->ListOptions->render("body", "left", $tbl_unload_preview->RowCnt);
?>
<?php if ($tbl_unload->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $tbl_unload->Code->cellAttributes() ?>>
<span<?php echo $tbl_unload->Code->viewAttributes() ?>>
<?php echo $tbl_unload->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
		<!-- IdCode -->
		<td<?php echo $tbl_unload->IdCode->cellAttributes() ?>>
<span<?php echo $tbl_unload->IdCode->viewAttributes() ?>>
<?php echo $tbl_unload->IdCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $tbl_unload->PCS->cellAttributes() ?>>
<span<?php echo $tbl_unload->PCS->viewAttributes() ?>>
<?php echo $tbl_unload->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
		<!-- RealPCS -->
		<td<?php echo $tbl_unload->RealPCS->cellAttributes() ?>>
<span<?php echo $tbl_unload->RealPCS->viewAttributes() ?>>
<?php echo $tbl_unload->RealPCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unload->Description->Visible) { // Description ?>
		<!-- Description -->
		<td<?php echo $tbl_unload->Description->cellAttributes() ?>>
<span<?php echo $tbl_unload->Description->viewAttributes() ?>>
<?php echo $tbl_unload->Description->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td<?php echo $tbl_unload->CreateUser->cellAttributes() ?>>
<span<?php echo $tbl_unload->CreateUser->viewAttributes() ?>>
<?php echo $tbl_unload->CreateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td<?php echo $tbl_unload->CreateDate->cellAttributes() ?>>
<span<?php echo $tbl_unload->CreateDate->viewAttributes() ?>>
<?php echo $tbl_unload->CreateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
		<!-- MFG -->
		<td<?php echo $tbl_unload->MFG->cellAttributes() ?>>
<span<?php echo $tbl_unload->MFG->viewAttributes() ?>>
<?php echo $tbl_unload->MFG->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_unload_preview->ListOptions->render("body", "right", $tbl_unload_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_unload_preview->Recordset->MoveNext();
}
?>
	</tbody>
<?php

	// Render aggregate row
	$tbl_unload_preview->aggregateListRow(); // Prepare aggregate row

	// Render list options
	$tbl_unload_preview->renderListOptions();
?>
	<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options (footer, left)
$tbl_unload_preview->ListOptions->render("footer", "left");
?>
<?php if ($tbl_unload->Code->Visible) { // Code ?>
		<!-- Code -->
		<td class="<?php echo $tbl_unload->Code->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
		<!-- IdCode -->
		<td class="<?php echo $tbl_unload->IdCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td class="<?php echo $tbl_unload->PCS->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_unload->PCS->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
		<!-- RealPCS -->
		<td class="<?php echo $tbl_unload->RealPCS->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_unload->RealPCS->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($tbl_unload->Description->Visible) { // Description ?>
		<!-- Description -->
		<td class="<?php echo $tbl_unload->Description->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td class="<?php echo $tbl_unload->CreateUser->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td class="<?php echo $tbl_unload->CreateDate->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
		<!-- MFG -->
		<td class="<?php echo $tbl_unload->MFG->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php

// Render list options (footer, right)
$tbl_unload_preview->ListOptions->render("footer", "right");
?>
	</tr>
	</tfoot>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($tbl_unload_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_unload_preview->Pager)) $tbl_unload_preview->Pager = new PrevNextPager($tbl_unload_preview->StartRec, $tbl_unload_preview->DisplayRecs, $tbl_unload_preview->TotalRecs) ?>
<?php if ($tbl_unload_preview->Pager->RecordCount > 0 && $tbl_unload_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($tbl_unload_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_unload_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_unload_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_unload_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_unload_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_unload_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_unload_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_unload_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_unload_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_unload_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_unload_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($tbl_unload_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$tbl_unload_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($tbl_unload_preview->Recordset)
	$tbl_unload_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$tbl_unload_preview->terminate();
?>