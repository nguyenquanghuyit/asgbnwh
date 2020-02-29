<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for nhanvien
 */
class nhanvien extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $Ma_NV;
	public $hoVaTen;
	public $gioiTinh;
	public $ngaySinh;
	public $emailCaNhan;
	public $TD_ID;
	public $PB_ID;
	public $noiSinh;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'nhanvien';
		$this->TableName = 'nhanvien';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`nhanvien`";
		$this->Dbid = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 8;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);
		$this->BasicSearch->TypeDefault = "OR";

		// Ma_NV
		$this->Ma_NV = new DbField('nhanvien', 'nhanvien', 'x_Ma_NV', 'Ma_NV', '`Ma_NV`', '`Ma_NV`', 200, -1, FALSE, '`Ma_NV`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Ma_NV->IsPrimaryKey = TRUE; // Primary key field
		$this->Ma_NV->Nullable = FALSE; // NOT NULL field
		$this->Ma_NV->Required = TRUE; // Required field
		$this->Ma_NV->Sortable = TRUE; // Allow sort
		$this->fields['Ma_NV'] = &$this->Ma_NV;

		// hoVaTen
		$this->hoVaTen = new DbField('nhanvien', 'nhanvien', 'x_hoVaTen', 'hoVaTen', '`hoVaTen`', '`hoVaTen`', 200, -1, FALSE, '`hoVaTen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hoVaTen->Sortable = TRUE; // Allow sort
		$this->fields['hoVaTen'] = &$this->hoVaTen;

		// gioiTinh
		$this->gioiTinh = new DbField('nhanvien', 'nhanvien', 'x_gioiTinh', 'gioiTinh', '`gioiTinh`', '`gioiTinh`', 200, -1, FALSE, '`gioiTinh`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->gioiTinh->Sortable = TRUE; // Allow sort
		$this->gioiTinh->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->gioiTinh->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->gioiTinh->Lookup = new Lookup('gioiTinh', 'nhanvien', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->gioiTinh->OptionCount = 2;
		$this->fields['gioiTinh'] = &$this->gioiTinh;

		// ngaySinh
		$this->ngaySinh = new DbField('nhanvien', 'nhanvien', 'x_ngaySinh', 'ngaySinh', '`ngaySinh`', CastDateFieldForLike('`ngaySinh`', 7, "DB"), 133, 7, FALSE, '`ngaySinh`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngaySinh->Sortable = TRUE; // Allow sort
		$this->ngaySinh->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['ngaySinh'] = &$this->ngaySinh;

		// emailCaNhan
		$this->emailCaNhan = new DbField('nhanvien', 'nhanvien', 'x_emailCaNhan', 'emailCaNhan', '`emailCaNhan`', '`emailCaNhan`', 200, -1, FALSE, '`emailCaNhan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->emailCaNhan->Sortable = TRUE; // Allow sort
		$this->fields['emailCaNhan'] = &$this->emailCaNhan;

		// TD_ID
		$this->TD_ID = new DbField('nhanvien', 'nhanvien', 'x_TD_ID', 'TD_ID', '`TD_ID`', '`TD_ID`', 3, -1, FALSE, '`EV__TD_ID`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->TD_ID->Sortable = TRUE; // Allow sort
		$this->TD_ID->Lookup = new Lookup('TD_ID', 'todoi', FALSE, 'TD_ID', ["TD_Tendd","","",""], [], [], [], [], [], [], '', '');
		$this->TD_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TD_ID'] = &$this->TD_ID;

		// PB_ID
		$this->PB_ID = new DbField('nhanvien', 'nhanvien', 'x_PB_ID', 'PB_ID', '`PB_ID`', '`PB_ID`', 3, -1, FALSE, '`EV__PB_ID`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->PB_ID->Sortable = TRUE; // Allow sort
		$this->PB_ID->Lookup = new Lookup('PB_ID', 'phongban', FALSE, 'PB_ID', ["PB_Tendd","","",""], [], [], [], [], [], [], '', '');
		$this->PB_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PB_ID'] = &$this->PB_ID;

		// noiSinh
		$this->noiSinh = new DbField('nhanvien', 'nhanvien', 'x_noiSinh', 'noiSinh', '`noiSinh`', '`noiSinh`', 200, -1, FALSE, '`noiSinh`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noiSinh->Sortable = FALSE; // Allow sort
		$this->fields['noiSinh'] = &$this->noiSinh;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Multiple column sort
	public function updateSort(&$fld, $ctrl)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($ctrl) {
				$orderBy = $this->getSessionOrderBy();
				if (ContainsString($orderBy, $sortField . " " . $lastSort)) {
					$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
				} else {
					if ($orderBy <> "")
						$orderBy .= ", ";
					$orderBy .= $sortField . " " . $thisSort;
				}
				$this->setSessionOrderBy($orderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			}
			$sortFieldList = ($fld->VirtualExpression <> "") ? $fld->VirtualExpression : $sortField;
			if ($ctrl) {
				$orderByList = $this->getSessionOrderByList();
				if (ContainsString($orderByList, $sortFieldList . " " . $lastSort)) {
					$orderByList = str_replace($sortFieldList . " " . $lastSort, $sortFieldList . " " . $thisSort, $orderByList);
				} else {
					if ($orderByList <> "") $orderByList .= ", ";
					$orderByList .= $sortFieldList . " " . $thisSort;
				}
				$this->setSessionOrderByList($orderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST] = $v;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`nhanvien`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT `TD_Tendd` FROM `todoi` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`TD_ID` = `nhanvien`.`TD_ID` LIMIT 1) AS `EV__TD_ID`, (SELECT `PB_Tendd` FROM `phongban` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`PB_ID` = `nhanvien`.`PB_ID` LIMIT 1) AS `EV__PB_ID` FROM `nhanvien`" .
			") `TMP_TABLE`";
		return ($this->SqlSelectList <> "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where <> "")
			$where = " " . str_replace(array("(",")"), array("",""), $where) . " ";
		if ($orderBy <> "")
			$orderBy = " " . str_replace(array("(",")"), array("",""), $orderBy) . " ";
		if ($this->BasicSearch->getKeyword() <> "")
			return TRUE;
		if ($this->TD_ID->AdvancedSearch->SearchValue <> "" ||
			$this->TD_ID->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->TD_ID->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->TD_ID->VirtualExpression . " "))
			return TRUE;
		if ($this->PB_ID->AdvancedSearch->SearchValue <> "" ||
			$this->PB_ID->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->PB_ID->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->PB_ID->VirtualExpression . " "))
			return TRUE;
		return FALSE;
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
			$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'Ma_NV';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('Ma_NV', $rs))
				AddFilter($where, QuotedName('Ma_NV', $this->Dbid) . '=' . QuotedValue($rs['Ma_NV'], $this->Ma_NV->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->Ma_NV->DbValue = $row['Ma_NV'];
		$this->hoVaTen->DbValue = $row['hoVaTen'];
		$this->gioiTinh->DbValue = $row['gioiTinh'];
		$this->ngaySinh->DbValue = $row['ngaySinh'];
		$this->emailCaNhan->DbValue = $row['emailCaNhan'];
		$this->TD_ID->DbValue = $row['TD_ID'];
		$this->PB_ID->DbValue = $row['PB_ID'];
		$this->noiSinh->DbValue = $row['noiSinh'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`Ma_NV` = '@Ma_NV@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('Ma_NV', $row) ? $row['Ma_NV'] : NULL) : $this->Ma_NV->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@Ma_NV@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "nhanvienlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "nhanvienview.php")
			return $Language->phrase("View");
		elseif ($pageName == "nhanvienedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "nhanvienadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "nhanvienlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("nhanvienview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("nhanvienview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "nhanvienadd.php?" . $this->getUrlParm($parm);
		else
			$url = "nhanvienadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("nhanvienedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("nhanvienadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("nhanviendelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "Ma_NV:" . JsonEncode($this->Ma_NV->CurrentValue, "string");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->Ma_NV->CurrentValue != NULL) {
			$url .= "Ma_NV=" . urlencode($this->Ma_NV->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("Ma_NV") !== NULL)
				$arKeys[] = Param("Ma_NV");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->Ma_NV->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->Ma_NV->setDbValue($rs->fields('Ma_NV'));
		$this->hoVaTen->setDbValue($rs->fields('hoVaTen'));
		$this->gioiTinh->setDbValue($rs->fields('gioiTinh'));
		$this->ngaySinh->setDbValue($rs->fields('ngaySinh'));
		$this->emailCaNhan->setDbValue($rs->fields('emailCaNhan'));
		$this->TD_ID->setDbValue($rs->fields('TD_ID'));
		$this->PB_ID->setDbValue($rs->fields('PB_ID'));
		$this->noiSinh->setDbValue($rs->fields('noiSinh'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// Ma_NV

		$this->Ma_NV->CellCssStyle = "white-space: nowrap;";

		// hoVaTen
		$this->hoVaTen->CellCssStyle = "white-space: nowrap;";

		// gioiTinh
		$this->gioiTinh->CellCssStyle = "white-space: nowrap;";

		// ngaySinh
		$this->ngaySinh->CellCssStyle = "white-space: nowrap;";

		// emailCaNhan
		$this->emailCaNhan->CellCssStyle = "white-space: nowrap;";

		// TD_ID
		$this->TD_ID->CellCssStyle = "white-space: nowrap;";

		// PB_ID
		$this->PB_ID->CellCssStyle = "white-space: nowrap;";

		// noiSinh
		$this->noiSinh->CellCssStyle = "white-space: nowrap;";

		// Ma_NV
		$this->Ma_NV->ViewValue = $this->Ma_NV->CurrentValue;
		$this->Ma_NV->ViewCustomAttributes = "";

		// hoVaTen
		$this->hoVaTen->ViewValue = $this->hoVaTen->CurrentValue;
		$this->hoVaTen->ViewCustomAttributes = "";

		// gioiTinh
		if (strval($this->gioiTinh->CurrentValue) <> "") {
			$this->gioiTinh->ViewValue = $this->gioiTinh->optionCaption($this->gioiTinh->CurrentValue);
		} else {
			$this->gioiTinh->ViewValue = NULL;
		}
		$this->gioiTinh->CellCssStyle .= "text-align: center;";
		$this->gioiTinh->ViewCustomAttributes = "";

		// ngaySinh
		$this->ngaySinh->ViewValue = $this->ngaySinh->CurrentValue;
		$this->ngaySinh->ViewValue = FormatDateTime($this->ngaySinh->ViewValue, 7);
		$this->ngaySinh->CellCssStyle .= "text-align: center;";
		$this->ngaySinh->ViewCustomAttributes = "";

		// emailCaNhan
		$this->emailCaNhan->ViewValue = $this->emailCaNhan->CurrentValue;
		$this->emailCaNhan->ViewCustomAttributes = "";

		// TD_ID
		if ($this->TD_ID->VirtualValue <> "") {
			$this->TD_ID->ViewValue = $this->TD_ID->VirtualValue;
		} else {
			$this->TD_ID->ViewValue = $this->TD_ID->CurrentValue;
		$curVal = strval($this->TD_ID->CurrentValue);
		if ($curVal <> "") {
			$this->TD_ID->ViewValue = $this->TD_ID->lookupCacheOption($curVal);
			if ($this->TD_ID->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`TD_ID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->TD_ID->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->TD_ID->ViewValue = $this->TD_ID->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->TD_ID->ViewValue = $this->TD_ID->CurrentValue;
				}
			}
		} else {
			$this->TD_ID->ViewValue = NULL;
		}
		}
		$this->TD_ID->ViewCustomAttributes = "";

		// PB_ID
		if ($this->PB_ID->VirtualValue <> "") {
			$this->PB_ID->ViewValue = $this->PB_ID->VirtualValue;
		} else {
			$this->PB_ID->ViewValue = $this->PB_ID->CurrentValue;
		$curVal = strval($this->PB_ID->CurrentValue);
		if ($curVal <> "") {
			$this->PB_ID->ViewValue = $this->PB_ID->lookupCacheOption($curVal);
			if ($this->PB_ID->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PB_ID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->PB_ID->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->PB_ID->ViewValue = $this->PB_ID->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PB_ID->ViewValue = $this->PB_ID->CurrentValue;
				}
			}
		} else {
			$this->PB_ID->ViewValue = NULL;
		}
		}
		$this->PB_ID->ViewCustomAttributes = "";

		// noiSinh
		$this->noiSinh->ViewValue = $this->noiSinh->CurrentValue;
		$this->noiSinh->ViewCustomAttributes = "";

		// Ma_NV
		$this->Ma_NV->LinkCustomAttributes = "";
		$this->Ma_NV->HrefValue = "";
		$this->Ma_NV->TooltipValue = "";

		// hoVaTen
		$this->hoVaTen->LinkCustomAttributes = "";
		$this->hoVaTen->HrefValue = "";
		$this->hoVaTen->TooltipValue = "";

		// gioiTinh
		$this->gioiTinh->LinkCustomAttributes = "";
		$this->gioiTinh->HrefValue = "";
		$this->gioiTinh->TooltipValue = "";

		// ngaySinh
		$this->ngaySinh->LinkCustomAttributes = "";
		$this->ngaySinh->HrefValue = "";
		$this->ngaySinh->TooltipValue = "";

		// emailCaNhan
		$this->emailCaNhan->LinkCustomAttributes = "";
		$this->emailCaNhan->HrefValue = "";
		$this->emailCaNhan->TooltipValue = "";

		// TD_ID
		$this->TD_ID->LinkCustomAttributes = "";
		$this->TD_ID->HrefValue = "";
		$this->TD_ID->TooltipValue = "";

		// PB_ID
		$this->PB_ID->LinkCustomAttributes = "";
		$this->PB_ID->HrefValue = "";
		$this->PB_ID->TooltipValue = "";

		// noiSinh
		$this->noiSinh->LinkCustomAttributes = "";
		$this->noiSinh->HrefValue = "";
		$this->noiSinh->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Ma_NV
		$this->Ma_NV->EditAttrs["class"] = "form-control";
		$this->Ma_NV->EditCustomAttributes = "";
		$this->Ma_NV->EditValue = $this->Ma_NV->CurrentValue;
		$this->Ma_NV->ViewCustomAttributes = "";

		// hoVaTen
		$this->hoVaTen->EditAttrs["class"] = "form-control";
		$this->hoVaTen->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->hoVaTen->CurrentValue = HtmlDecode($this->hoVaTen->CurrentValue);
		$this->hoVaTen->EditValue = $this->hoVaTen->CurrentValue;
		$this->hoVaTen->PlaceHolder = RemoveHtml($this->hoVaTen->caption());

		// gioiTinh
		$this->gioiTinh->EditAttrs["class"] = "form-control";
		$this->gioiTinh->EditCustomAttributes = "";
		$this->gioiTinh->EditValue = $this->gioiTinh->options(TRUE);

		// ngaySinh
		$this->ngaySinh->EditAttrs["class"] = "form-control";
		$this->ngaySinh->EditCustomAttributes = "";
		$this->ngaySinh->EditValue = FormatDateTime($this->ngaySinh->CurrentValue, 7);
		$this->ngaySinh->PlaceHolder = RemoveHtml($this->ngaySinh->caption());

		// emailCaNhan
		$this->emailCaNhan->EditAttrs["class"] = "form-control";
		$this->emailCaNhan->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->emailCaNhan->CurrentValue = HtmlDecode($this->emailCaNhan->CurrentValue);
		$this->emailCaNhan->EditValue = $this->emailCaNhan->CurrentValue;
		$this->emailCaNhan->PlaceHolder = RemoveHtml($this->emailCaNhan->caption());

		// TD_ID
		$this->TD_ID->EditAttrs["class"] = "form-control";
		$this->TD_ID->EditCustomAttributes = "";
		$this->TD_ID->EditValue = $this->TD_ID->CurrentValue;
		$this->TD_ID->PlaceHolder = RemoveHtml($this->TD_ID->caption());

		// PB_ID
		$this->PB_ID->EditAttrs["class"] = "form-control";
		$this->PB_ID->EditCustomAttributes = "";
		$this->PB_ID->EditValue = $this->PB_ID->CurrentValue;
		$this->PB_ID->PlaceHolder = RemoveHtml($this->PB_ID->caption());

		// noiSinh
		$this->noiSinh->EditAttrs["class"] = "form-control";
		$this->noiSinh->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->noiSinh->CurrentValue = HtmlDecode($this->noiSinh->CurrentValue);
		$this->noiSinh->EditValue = $this->noiSinh->CurrentValue;
		$this->noiSinh->PlaceHolder = RemoveHtml($this->noiSinh->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->Ma_NV);
					$doc->exportCaption($this->hoVaTen);
					$doc->exportCaption($this->gioiTinh);
					$doc->exportCaption($this->ngaySinh);
					$doc->exportCaption($this->emailCaNhan);
					$doc->exportCaption($this->TD_ID);
					$doc->exportCaption($this->PB_ID);
				} else {
					$doc->exportCaption($this->Ma_NV);
					$doc->exportCaption($this->hoVaTen);
					$doc->exportCaption($this->gioiTinh);
					$doc->exportCaption($this->ngaySinh);
					$doc->exportCaption($this->emailCaNhan);
					$doc->exportCaption($this->TD_ID);
					$doc->exportCaption($this->PB_ID);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->Ma_NV);
						$doc->exportField($this->hoVaTen);
						$doc->exportField($this->gioiTinh);
						$doc->exportField($this->ngaySinh);
						$doc->exportField($this->emailCaNhan);
						$doc->exportField($this->TD_ID);
						$doc->exportField($this->PB_ID);
					} else {
						$doc->exportField($this->Ma_NV);
						$doc->exportField($this->hoVaTen);
						$doc->exportField($this->gioiTinh);
						$doc->exportField($this->ngaySinh);
						$doc->exportField($this->emailCaNhan);
						$doc->exportField($this->TD_ID);
						$doc->exportField($this->PB_ID);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
					$Security->loadCurrentUserLevel($PROJECT_ID . $this->TableName);
					if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
					$validRequest = $Security->canList(); // List permission
					if ($validRequest) {
						$Security->UserID_Loading();
						$Security->loadUserID();
						$Security->UserID_Loaded();
					}
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(CurrentProjectID() . $this->TableName);
			$Security->TablePermission_Loaded();
			$validRequest = $Security->canList(); // List permission
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'nhanvien';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'nhanvien';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['Ma_NV'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'nhanvien';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['Ma_NV'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) <> FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'nhanvien';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['Ma_NV'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>