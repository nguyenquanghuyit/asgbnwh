<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for vwPackingdetail
 */
class vwPackingdetail extends DbTable
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

	// Export
	public $ExportDoc;

	// Fields
	public $Id_packing;
	public $Id_order;
	public $Code;
	public $PCS;
	public $PackingType;
	public $Length;
	public $Width;
	public $Heigth;
	public $finishpacking;
	public $PE_film_Cover;
	public $CreateUser;
	public $CreateDate;
	public $Box;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'vwPackingdetail';
		$this->TableName = 'vwPackingdetail';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`vwPackingdetail`";
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

		// Id_packing
		$this->Id_packing = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_Id_packing', 'Id_packing', '`Id_packing`', '`Id_packing`', 20, -1, FALSE, '`Id_packing`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->Id_packing->IsAutoIncrement = TRUE; // Autoincrement field
		$this->Id_packing->IsPrimaryKey = TRUE; // Primary key field
		$this->Id_packing->Sortable = TRUE; // Allow sort
		$this->Id_packing->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Id_packing'] = &$this->Id_packing;

		// Id_order
		$this->Id_order = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_Id_order', 'Id_order', '`Id_order`', '`Id_order`', 3, -1, FALSE, '`Id_order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Id_order->IsForeignKey = TRUE; // Foreign key field
		$this->Id_order->Sortable = TRUE; // Allow sort
		$this->Id_order->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Id_order'] = &$this->Id_order;

		// Code
		$this->Code = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_Code', 'Code', '`Code`', '`Code`', 200, -1, FALSE, '`Code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Code->Nullable = FALSE; // NOT NULL field
		$this->Code->Required = TRUE; // Required field
		$this->Code->Sortable = TRUE; // Allow sort
		$this->fields['Code'] = &$this->Code;

		// PCS
		$this->PCS = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_PCS', 'PCS', '`PCS`', '`PCS`', 3, -1, FALSE, '`PCS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PCS->Sortable = TRUE; // Allow sort
		$this->PCS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PCS'] = &$this->PCS;

		// PackingType
		$this->PackingType = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_PackingType', 'PackingType', '`PackingType`', '`PackingType`', 200, -1, FALSE, '`PackingType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PackingType->Sortable = TRUE; // Allow sort
		$this->fields['PackingType'] = &$this->PackingType;

		// Length
		$this->Length = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_Length', 'Length', '`Length`', '`Length`', 3, -1, FALSE, '`Length`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Length->Sortable = TRUE; // Allow sort
		$this->Length->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Length'] = &$this->Length;

		// Width
		$this->Width = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_Width', 'Width', '`Width`', '`Width`', 3, -1, FALSE, '`Width`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Width->Sortable = TRUE; // Allow sort
		$this->Width->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Width'] = &$this->Width;

		// Heigth
		$this->Heigth = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_Heigth', 'Heigth', '`Heigth`', '`Heigth`', 3, -1, FALSE, '`Heigth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Heigth->Sortable = TRUE; // Allow sort
		$this->Heigth->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Heigth'] = &$this->Heigth;

		// finishpacking
		$this->finishpacking = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_finishpacking', 'finishpacking', '`finishpacking`', '`finishpacking`', 16, -1, FALSE, '`finishpacking`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->finishpacking->Sortable = TRUE; // Allow sort
		$this->finishpacking->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['finishpacking'] = &$this->finishpacking;

		// PE_film_Cover
		$this->PE_film_Cover = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_PE_film_Cover', 'PE_film_Cover', '`PE_film_Cover`', '`PE_film_Cover`', 16, -1, FALSE, '`PE_film_Cover`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PE_film_Cover->Sortable = TRUE; // Allow sort
		$this->PE_film_Cover->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PE_film_Cover'] = &$this->PE_film_Cover;

		// CreateUser
		$this->CreateUser = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_CreateUser', 'CreateUser', '`CreateUser`', '`CreateUser`', 200, -1, FALSE, '`CreateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateUser->Sortable = TRUE; // Allow sort
		$this->fields['CreateUser'] = &$this->CreateUser;

		// CreateDate
		$this->CreateDate = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_CreateDate', 'CreateDate', '`CreateDate`', CastDateFieldForLike('`CreateDate`', 0, "DB"), 135, 0, FALSE, '`CreateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateDate->Sortable = TRUE; // Allow sort
		$this->CreateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['CreateDate'] = &$this->CreateDate;

		// Box
		$this->Box = new DbField('vwPackingdetail', 'vwPackingdetail', 'x_Box', 'Box', '`Box`', '`Box`', 3, -1, FALSE, '`Box`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Box->Sortable = TRUE; // Allow sort
		$this->Box->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Box'] = &$this->Box;
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
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_MASTER_TABLE];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "tbl_order") {
			if ($this->Id_order->getSessionValue() <> "")
				$masterFilter .= "`ID_Order`=" . QuotedValue($this->Id_order->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "tbl_order") {
			if ($this->Id_order->getSessionValue() <> "")
				$detailFilter .= "`Id_order`=" . QuotedValue($this->Id_order->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_tbl_order()
	{
		return "`ID_Order`=@ID_Order@";
	}

	// Detail filter
	public function sqlDetailFilter_tbl_order()
	{
		return "`Id_order`=@Id_order@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`vwPackingdetail`";
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
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
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

			// Get insert id if necessary
			$this->Id_packing->setDbValue($conn->insert_ID());
			$rs['Id_packing'] = $this->Id_packing->DbValue;
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
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('Id_packing', $rs))
				AddFilter($where, QuotedName('Id_packing', $this->Dbid) . '=' . QuotedValue($rs['Id_packing'], $this->Id_packing->DataType, $this->Dbid));
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
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->Id_packing->DbValue = $row['Id_packing'];
		$this->Id_order->DbValue = $row['Id_order'];
		$this->Code->DbValue = $row['Code'];
		$this->PCS->DbValue = $row['PCS'];
		$this->PackingType->DbValue = $row['PackingType'];
		$this->Length->DbValue = $row['Length'];
		$this->Width->DbValue = $row['Width'];
		$this->Heigth->DbValue = $row['Heigth'];
		$this->finishpacking->DbValue = $row['finishpacking'];
		$this->PE_film_Cover->DbValue = $row['PE_film_Cover'];
		$this->CreateUser->DbValue = $row['CreateUser'];
		$this->CreateDate->DbValue = $row['CreateDate'];
		$this->Box->DbValue = $row['Box'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`Id_packing` = @Id_packing@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('Id_packing', $row) ? $row['Id_packing'] : NULL) : $this->Id_packing->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@Id_packing@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "vwPackingdetaillist.php";
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
		if ($pageName == "vwPackingdetailview.php")
			return $Language->phrase("View");
		elseif ($pageName == "vwPackingdetailedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "vwPackingdetailadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "vwPackingdetaillist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("vwPackingdetailview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("vwPackingdetailview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "vwPackingdetailadd.php?" . $this->getUrlParm($parm);
		else
			$url = "vwPackingdetailadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("vwPackingdetailedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("vwPackingdetailadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("vwPackingdetaildelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "tbl_order" && !ContainsString($url, TABLE_SHOW_MASTER . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ID_Order=" . urlencode($this->Id_order->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "Id_packing:" . JsonEncode($this->Id_packing->CurrentValue, "number");
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
		if ($this->Id_packing->CurrentValue != NULL) {
			$url .= "Id_packing=" . urlencode($this->Id_packing->CurrentValue);
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
			if (Param("Id_packing") !== NULL)
				$arKeys[] = Param("Id_packing");
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
				if (!is_numeric($key))
					continue;
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
			$this->Id_packing->CurrentValue = $key;
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
		$this->Id_packing->setDbValue($rs->fields('Id_packing'));
		$this->Id_order->setDbValue($rs->fields('Id_order'));
		$this->Code->setDbValue($rs->fields('Code'));
		$this->PCS->setDbValue($rs->fields('PCS'));
		$this->PackingType->setDbValue($rs->fields('PackingType'));
		$this->Length->setDbValue($rs->fields('Length'));
		$this->Width->setDbValue($rs->fields('Width'));
		$this->Heigth->setDbValue($rs->fields('Heigth'));
		$this->finishpacking->setDbValue($rs->fields('finishpacking'));
		$this->PE_film_Cover->setDbValue($rs->fields('PE_film_Cover'));
		$this->CreateUser->setDbValue($rs->fields('CreateUser'));
		$this->CreateDate->setDbValue($rs->fields('CreateDate'));
		$this->Box->setDbValue($rs->fields('Box'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// Id_packing
		// Id_order
		// Code
		// PCS
		// PackingType
		// Length
		// Width
		// Heigth
		// finishpacking
		// PE_film_Cover
		// CreateUser
		// CreateDate
		// Box
		// Id_packing

		$this->Id_packing->ViewValue = $this->Id_packing->CurrentValue;
		$this->Id_packing->ViewCustomAttributes = "";

		// Id_order
		$this->Id_order->ViewValue = $this->Id_order->CurrentValue;
		$this->Id_order->ViewValue = FormatNumber($this->Id_order->ViewValue, 0, -2, -2, -2);
		$this->Id_order->ViewCustomAttributes = "";

		// Code
		$this->Code->ViewValue = $this->Code->CurrentValue;
		$this->Code->ViewCustomAttributes = "";

		// PCS
		$this->PCS->ViewValue = $this->PCS->CurrentValue;
		$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
		$this->PCS->ViewCustomAttributes = "";

		// PackingType
		$this->PackingType->ViewValue = $this->PackingType->CurrentValue;
		$this->PackingType->ViewCustomAttributes = "";

		// Length
		$this->Length->ViewValue = $this->Length->CurrentValue;
		$this->Length->ViewValue = FormatNumber($this->Length->ViewValue, 0, -2, -2, -2);
		$this->Length->ViewCustomAttributes = "";

		// Width
		$this->Width->ViewValue = $this->Width->CurrentValue;
		$this->Width->ViewValue = FormatNumber($this->Width->ViewValue, 0, -2, -2, -2);
		$this->Width->ViewCustomAttributes = "";

		// Heigth
		$this->Heigth->ViewValue = $this->Heigth->CurrentValue;
		$this->Heigth->ViewValue = FormatNumber($this->Heigth->ViewValue, 0, -2, -2, -2);
		$this->Heigth->ViewCustomAttributes = "";

		// finishpacking
		$this->finishpacking->ViewValue = $this->finishpacking->CurrentValue;
		$this->finishpacking->ViewValue = FormatNumber($this->finishpacking->ViewValue, 0, -2, -2, -2);
		$this->finishpacking->ViewCustomAttributes = "";

		// PE_film_Cover
		$this->PE_film_Cover->ViewValue = $this->PE_film_Cover->CurrentValue;
		$this->PE_film_Cover->ViewValue = FormatNumber($this->PE_film_Cover->ViewValue, 0, -2, -2, -2);
		$this->PE_film_Cover->ViewCustomAttributes = "";

		// CreateUser
		$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->ViewCustomAttributes = "";

		// CreateDate
		$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
		$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 0);
		$this->CreateDate->ViewCustomAttributes = "";

		// Box
		$this->Box->ViewValue = $this->Box->CurrentValue;
		$this->Box->ViewValue = FormatNumber($this->Box->ViewValue, 0, -2, -2, -2);
		$this->Box->ViewCustomAttributes = "";

		// Id_packing
		$this->Id_packing->LinkCustomAttributes = "";
		$this->Id_packing->HrefValue = "";
		$this->Id_packing->TooltipValue = "";

		// Id_order
		$this->Id_order->LinkCustomAttributes = "";
		$this->Id_order->HrefValue = "";
		$this->Id_order->TooltipValue = "";

		// Code
		$this->Code->LinkCustomAttributes = "";
		$this->Code->HrefValue = "";
		$this->Code->TooltipValue = "";

		// PCS
		$this->PCS->LinkCustomAttributes = "";
		$this->PCS->HrefValue = "";
		$this->PCS->TooltipValue = "";

		// PackingType
		$this->PackingType->LinkCustomAttributes = "";
		$this->PackingType->HrefValue = "";
		$this->PackingType->TooltipValue = "";

		// Length
		$this->Length->LinkCustomAttributes = "";
		$this->Length->HrefValue = "";
		$this->Length->TooltipValue = "";

		// Width
		$this->Width->LinkCustomAttributes = "";
		$this->Width->HrefValue = "";
		$this->Width->TooltipValue = "";

		// Heigth
		$this->Heigth->LinkCustomAttributes = "";
		$this->Heigth->HrefValue = "";
		$this->Heigth->TooltipValue = "";

		// finishpacking
		$this->finishpacking->LinkCustomAttributes = "";
		$this->finishpacking->HrefValue = "";
		$this->finishpacking->TooltipValue = "";

		// PE_film_Cover
		$this->PE_film_Cover->LinkCustomAttributes = "";
		$this->PE_film_Cover->HrefValue = "";
		$this->PE_film_Cover->TooltipValue = "";

		// CreateUser
		$this->CreateUser->LinkCustomAttributes = "";
		$this->CreateUser->HrefValue = "";
		$this->CreateUser->TooltipValue = "";

		// CreateDate
		$this->CreateDate->LinkCustomAttributes = "";
		$this->CreateDate->HrefValue = "";
		$this->CreateDate->TooltipValue = "";

		// Box
		$this->Box->LinkCustomAttributes = "";
		$this->Box->HrefValue = "";
		$this->Box->TooltipValue = "";

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

		// Id_packing
		$this->Id_packing->EditAttrs["class"] = "form-control";
		$this->Id_packing->EditCustomAttributes = "";
		$this->Id_packing->EditValue = $this->Id_packing->CurrentValue;
		$this->Id_packing->ViewCustomAttributes = "";

		// Id_order
		$this->Id_order->EditAttrs["class"] = "form-control";
		$this->Id_order->EditCustomAttributes = "";
		if ($this->Id_order->getSessionValue() <> "") {
			$this->Id_order->CurrentValue = $this->Id_order->getSessionValue();
		$this->Id_order->ViewValue = $this->Id_order->CurrentValue;
		$this->Id_order->ViewValue = FormatNumber($this->Id_order->ViewValue, 0, -2, -2, -2);
		$this->Id_order->ViewCustomAttributes = "";
		} else {
		$this->Id_order->EditValue = $this->Id_order->CurrentValue;
		$this->Id_order->PlaceHolder = RemoveHtml($this->Id_order->caption());
		}

		// Code
		$this->Code->EditAttrs["class"] = "form-control";
		$this->Code->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
		$this->Code->EditValue = $this->Code->CurrentValue;
		$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

		// PCS
		$this->PCS->EditAttrs["class"] = "form-control";
		$this->PCS->EditCustomAttributes = "";
		$this->PCS->EditValue = $this->PCS->CurrentValue;
		$this->PCS->PlaceHolder = RemoveHtml($this->PCS->caption());

		// PackingType
		$this->PackingType->EditAttrs["class"] = "form-control";
		$this->PackingType->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->PackingType->CurrentValue = HtmlDecode($this->PackingType->CurrentValue);
		$this->PackingType->EditValue = $this->PackingType->CurrentValue;
		$this->PackingType->PlaceHolder = RemoveHtml($this->PackingType->caption());

		// Length
		$this->Length->EditAttrs["class"] = "form-control";
		$this->Length->EditCustomAttributes = "";
		$this->Length->EditValue = $this->Length->CurrentValue;
		$this->Length->PlaceHolder = RemoveHtml($this->Length->caption());

		// Width
		$this->Width->EditAttrs["class"] = "form-control";
		$this->Width->EditCustomAttributes = "";
		$this->Width->EditValue = $this->Width->CurrentValue;
		$this->Width->PlaceHolder = RemoveHtml($this->Width->caption());

		// Heigth
		$this->Heigth->EditAttrs["class"] = "form-control";
		$this->Heigth->EditCustomAttributes = "";
		$this->Heigth->EditValue = $this->Heigth->CurrentValue;
		$this->Heigth->PlaceHolder = RemoveHtml($this->Heigth->caption());

		// finishpacking
		$this->finishpacking->EditAttrs["class"] = "form-control";
		$this->finishpacking->EditCustomAttributes = "";
		$this->finishpacking->EditValue = $this->finishpacking->CurrentValue;
		$this->finishpacking->PlaceHolder = RemoveHtml($this->finishpacking->caption());

		// PE_film_Cover
		$this->PE_film_Cover->EditAttrs["class"] = "form-control";
		$this->PE_film_Cover->EditCustomAttributes = "";
		$this->PE_film_Cover->EditValue = $this->PE_film_Cover->CurrentValue;
		$this->PE_film_Cover->PlaceHolder = RemoveHtml($this->PE_film_Cover->caption());

		// CreateUser
		$this->CreateUser->EditAttrs["class"] = "form-control";
		$this->CreateUser->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->CreateUser->CurrentValue = HtmlDecode($this->CreateUser->CurrentValue);
		$this->CreateUser->EditValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->PlaceHolder = RemoveHtml($this->CreateUser->caption());

		// CreateDate
		$this->CreateDate->EditAttrs["class"] = "form-control";
		$this->CreateDate->EditCustomAttributes = "";
		$this->CreateDate->EditValue = FormatDateTime($this->CreateDate->CurrentValue, 8);
		$this->CreateDate->PlaceHolder = RemoveHtml($this->CreateDate->caption());

		// Box
		$this->Box->EditAttrs["class"] = "form-control";
		$this->Box->EditCustomAttributes = "";
		$this->Box->EditValue = $this->Box->CurrentValue;
		$this->Box->PlaceHolder = RemoveHtml($this->Box->caption());

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
					$doc->exportCaption($this->Id_packing);
					$doc->exportCaption($this->Id_order);
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->PCS);
					$doc->exportCaption($this->PackingType);
					$doc->exportCaption($this->Length);
					$doc->exportCaption($this->Width);
					$doc->exportCaption($this->Heigth);
					$doc->exportCaption($this->finishpacking);
					$doc->exportCaption($this->PE_film_Cover);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->Box);
				} else {
					$doc->exportCaption($this->Id_packing);
					$doc->exportCaption($this->Id_order);
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->PCS);
					$doc->exportCaption($this->PackingType);
					$doc->exportCaption($this->Length);
					$doc->exportCaption($this->Width);
					$doc->exportCaption($this->Heigth);
					$doc->exportCaption($this->finishpacking);
					$doc->exportCaption($this->PE_film_Cover);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->Box);
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
						$doc->exportField($this->Id_packing);
						$doc->exportField($this->Id_order);
						$doc->exportField($this->Code);
						$doc->exportField($this->PCS);
						$doc->exportField($this->PackingType);
						$doc->exportField($this->Length);
						$doc->exportField($this->Width);
						$doc->exportField($this->Heigth);
						$doc->exportField($this->finishpacking);
						$doc->exportField($this->PE_film_Cover);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->Box);
					} else {
						$doc->exportField($this->Id_packing);
						$doc->exportField($this->Id_order);
						$doc->exportField($this->Code);
						$doc->exportField($this->PCS);
						$doc->exportField($this->PackingType);
						$doc->exportField($this->Length);
						$doc->exportField($this->Width);
						$doc->exportField($this->Heigth);
						$doc->exportField($this->finishpacking);
						$doc->exportField($this->PE_film_Cover);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->Box);
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