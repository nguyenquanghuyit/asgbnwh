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
$tbl_goodsinpack_preview = new tbl_goodsinpack_preview();

// Run the page
$tbl_goodsinpack_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_goodsinpack_preview->Page_Render();
?>
<?php $tbl_goodsinpack_preview->showPageHeader(); ?>
<div class="card ew-grid tbl_goodsinpack"><!-- .card -->
<?php if ($tbl_goodsinpack_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$tbl_goodsinpack_preview->renderListOptions();

// Render list options (header, left)
$tbl_goodsinpack_preview->ListOptions->render("header", "left");
?>
<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
	<?php if ($tbl_goodsinpack->SortUrl($tbl_goodsinpack->Code) == "") { ?>
		<th class="<?php echo $tbl_goodsinpack->Code->headerCellClass() ?>"><?php echo $tbl_goodsinpack->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_goodsinpack->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_goodsinpack->Code->Name ?>" data-sort-order="<?php echo $tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->Code->Name && $tbl_goodsinpack_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->Code->Name) { ?><?php if ($tbl_goodsinpack_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_goodsinpack_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
	<?php if ($tbl_goodsinpack->SortUrl($tbl_goodsinpack->PCS) == "") { ?>
		<th class="<?php echo $tbl_goodsinpack->PCS->headerCellClass() ?>"><?php echo $tbl_goodsinpack->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_goodsinpack->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_goodsinpack->PCS->Name ?>" data-sort-order="<?php echo $tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->PCS->Name && $tbl_goodsinpack_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->PCS->Name) { ?><?php if ($tbl_goodsinpack_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_goodsinpack_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_goodsinpack->SortUrl($tbl_goodsinpack->CreateUser) == "") { ?>
		<th class="<?php echo $tbl_goodsinpack->CreateUser->headerCellClass() ?>"><?php echo $tbl_goodsinpack->CreateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_goodsinpack->CreateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_goodsinpack->CreateUser->Name ?>" data-sort-order="<?php echo $tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->CreateUser->Name && $tbl_goodsinpack_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->CreateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->CreateUser->Name) { ?><?php if ($tbl_goodsinpack_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_goodsinpack_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_goodsinpack->SortUrl($tbl_goodsinpack->CreateDate) == "") { ?>
		<th class="<?php echo $tbl_goodsinpack->CreateDate->headerCellClass() ?>"><?php echo $tbl_goodsinpack->CreateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_goodsinpack->CreateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_goodsinpack->CreateDate->Name ?>" data-sort-order="<?php echo $tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->CreateDate->Name && $tbl_goodsinpack_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->CreateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->CreateDate->Name) { ?><?php if ($tbl_goodsinpack_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_goodsinpack_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($tbl_goodsinpack->SortUrl($tbl_goodsinpack->UpdateUser) == "") { ?>
		<th class="<?php echo $tbl_goodsinpack->UpdateUser->headerCellClass() ?>"><?php echo $tbl_goodsinpack->UpdateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_goodsinpack->UpdateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_goodsinpack->UpdateUser->Name ?>" data-sort-order="<?php echo $tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->UpdateUser->Name && $tbl_goodsinpack_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->UpdateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->UpdateUser->Name) { ?><?php if ($tbl_goodsinpack_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_goodsinpack_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
	<?php if ($tbl_goodsinpack->SortUrl($tbl_goodsinpack->UpdateDatetime) == "") { ?>
		<th class="<?php echo $tbl_goodsinpack->UpdateDatetime->headerCellClass() ?>"><?php echo $tbl_goodsinpack->UpdateDatetime->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_goodsinpack->UpdateDatetime->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_goodsinpack->UpdateDatetime->Name ?>" data-sort-order="<?php echo $tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->UpdateDatetime->Name && $tbl_goodsinpack_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->UpdateDatetime->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_goodsinpack_preview->SortField == $tbl_goodsinpack->UpdateDatetime->Name) { ?><?php if ($tbl_goodsinpack_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_goodsinpack_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_goodsinpack_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_goodsinpack_preview->RecCount = 0;
$tbl_goodsinpack_preview->RowCnt = 0;
while ($tbl_goodsinpack_preview->Recordset && !$tbl_goodsinpack_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_goodsinpack_preview->RecCount++;
	$tbl_goodsinpack_preview->RowCnt++;
	$tbl_goodsinpack_preview->CssStyle = "";
	$tbl_goodsinpack_preview->loadListRowValues($tbl_goodsinpack_preview->Recordset);
	$tbl_goodsinpack_preview->aggregateListRowValues(); // Aggregate row values

	// Render row
	$tbl_goodsinpack_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$tbl_goodsinpack_preview->resetAttributes();
	$tbl_goodsinpack_preview->renderListRow();

	// Render list options
	$tbl_goodsinpack_preview->renderListOptions();
?>
	<tr<?php echo $tbl_goodsinpack_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_goodsinpack_preview->ListOptions->render("body", "left", $tbl_goodsinpack_preview->RowCnt);
?>
<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $tbl_goodsinpack->Code->cellAttributes() ?>>
<span<?php echo $tbl_goodsinpack->Code->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $tbl_goodsinpack->PCS->cellAttributes() ?>>
<span<?php echo $tbl_goodsinpack->PCS->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td<?php echo $tbl_goodsinpack->CreateUser->cellAttributes() ?>>
<span<?php echo $tbl_goodsinpack->CreateUser->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->CreateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td<?php echo $tbl_goodsinpack->CreateDate->cellAttributes() ?>>
<span<?php echo $tbl_goodsinpack->CreateDate->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->CreateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
		<!-- UpdateUser -->
		<td<?php echo $tbl_goodsinpack->UpdateUser->cellAttributes() ?>>
<span<?php echo $tbl_goodsinpack->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->UpdateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
		<!-- UpdateDatetime -->
		<td<?php echo $tbl_goodsinpack->UpdateDatetime->cellAttributes() ?>>
<span<?php echo $tbl_goodsinpack->UpdateDatetime->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->UpdateDatetime->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_goodsinpack_preview->ListOptions->render("body", "right", $tbl_goodsinpack_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_goodsinpack_preview->Recordset->MoveNext();
}
?>
	</tbody>
<?php

	// Render aggregate row
	$tbl_goodsinpack_preview->aggregateListRow(); // Prepare aggregate row

	// Render list options
	$tbl_goodsinpack_preview->renderListOptions();
?>
	<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options (footer, left)
$tbl_goodsinpack_preview->ListOptions->render("footer", "left");
?>
<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
		<!-- Code -->
		<td class="<?php echo $tbl_goodsinpack->Code->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td class="<?php echo $tbl_goodsinpack->PCS->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_goodsinpack->PCS->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td class="<?php echo $tbl_goodsinpack->CreateUser->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td class="<?php echo $tbl_goodsinpack->CreateDate->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
		<!-- UpdateUser -->
		<td class="<?php echo $tbl_goodsinpack->UpdateUser->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
		<!-- UpdateDatetime -->
		<td class="<?php echo $tbl_goodsinpack->UpdateDatetime->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php

// Render list options (footer, right)
$tbl_goodsinpack_preview->ListOptions->render("footer", "right");
?>
	</tr>
	</tfoot>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($tbl_goodsinpack_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_goodsinpack_preview->Pager)) $tbl_goodsinpack_preview->Pager = new PrevNextPager($tbl_goodsinpack_preview->StartRec, $tbl_goodsinpack_preview->DisplayRecs, $tbl_goodsinpack_preview->TotalRecs) ?>
<?php if ($tbl_goodsinpack_preview->Pager->RecordCount > 0 && $tbl_goodsinpack_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($tbl_goodsinpack_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_goodsinpack_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_goodsinpack_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_goodsinpack_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_goodsinpack_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_goodsinpack_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_goodsinpack_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_goodsinpack_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_goodsinpack_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_goodsinpack_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_goodsinpack_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($tbl_goodsinpack_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$tbl_goodsinpack_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($tbl_goodsinpack_preview->Recordset)
	$tbl_goodsinpack_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$tbl_goodsinpack_preview->terminate();
?>