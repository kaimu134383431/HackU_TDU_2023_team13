let csvData = null;
const roomdata = {}; // オブジェクトを初期化

function loadCSV(callback) {
	if (csvData) {
		callback(csvData);
	} else {
		// CSVファイルのパスを指定
		const csvFilePath = 'csv/data.csv';

		// XMLHttpRequestオブジェクトを使用してCSVファイルを読み込む
		const xhr = new XMLHttpRequest();
		xhr.open('GET', csvFilePath, true);
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				csvData = xhr.responseText;
				callback(csvData);
			}
		};
		xhr.send();
	}
}

function processData(csvData) {
	// 改行で分割し、各行を配列に格納
	const lines = csvData.split(/\r?\n/);
	// CSVデータをオブジェクトに変換
	const roomData = convertCSVToObject(lines);
	return roomData;
}

function convertCSVToObject(lines) {
	lines.forEach(function (line) {
		const parts = line.split(",");
		if (parts.length === 5) {
			const roomKey = parts[1].trim(); // 部屋番号をキーとして使用
			const numberOfUsers = parts[2].trim();
			const reservationDate = parts[3].trim();
			const reservationTime = parts[4].trim();

			if (!roomdata[roomKey]) {
				roomdata[roomKey] = [];
			}

			roomdata[roomKey].push({
				users: numberOfUsers,
				date: reservationDate,
				time: reservationTime,
			});
		}
	});

	return roomdata;
}

// CSVデータをロードしてオブジェクトに変換
document.addEventListener("DOMContentLoaded", function() {
	loadCSV(processData);
});
