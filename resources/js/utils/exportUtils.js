/**
 * Exports data to CSV file
 * @param {Array} data - Array of objects to export
 * @param {string} filename - Name of the file (without .csv extension)
 * @param {Array} headers - Optional custom headers
 */
export const exportToCSV = (data, filename = "export", headers = null) => {
    if (!data || !data.length) {
        console.error("No data to export");
        return;
    }

    // Use provided headers or extract from first object
    const csvHeaders = headers || Object.keys(data[0]);
    const headerRow = csvHeaders.join(",");

    // Convert data to CSV rows
    const csvRows = data.map((item) =>
        csvHeaders
            .map((header) => {
                // Escape quotes and wrap in quotes
                const value = item[header] !== undefined ? item[header] : "";
                return `"${String(value).replace(/"/g, '""')}"`;
            })
            .join(",")
    );

    // Combine header and rows
    const csvContent = [headerRow, ...csvRows].join("\n");

    // Create download link
    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const url = URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.setAttribute("href", url);
    link.setAttribute(
        "download",
        `${filename}_${new Date().toISOString().slice(0, 10)}.csv`
    );
    link.style.visibility = "hidden";

    // Trigger download
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};

// Optional: Add other export formats if needed
export const exportToJSON = (data, filename) => {
    // Similar implementation for JSON export
};
