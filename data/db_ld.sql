CREATE TABLE tbl_students_dashboard(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    uid TEXT NOT NULL,
    is_active INTEGER NOT NULL DEFAULT 1 CHECK (is_active IN (0, 1)),
    is_completer INTEGER NOT NULL DEFAULT 1 CHECK (is_completer IN (0, 1)),
    is_baptism INTEGER NOT NULL DEFAULT 0 CHECK (is_baptism IN (0, 1)),
    FOREIGN KEY (uid) REFERENCES tbl_students_main(uid)
);