function handleMapClick(mapId) {
    const svg = document.getElementById(mapId); // 特定の mapId を持つ SVG 要素を取得

    if (svg) {
        const clickableAreas = svg.querySelectorAll(`[data-room]`);

        clickableAreas.forEach((area) => {
            area.addEventListener("click", handleRoomClick); // クリックイベントリスナーを設定
        });

        // クリックされた部屋の情報を処理する関数
        function handleRoomClick(event) {
            
            const clickedArea = event.target;
            const roomName = clickedArea.getAttribute("data-room");
            const status = parseInt(clickedArea.getAttribute("data-status"));

            if (status === -1) {
                return;
            }

            const reservationData = roomdata[roomName]; // 部屋の予約情報を取得 

            const stTimeVal = stTime.value;
            const enTimeVal = enTime.value;
            const reserVal = reservatingDate.value;

            if (!stTimeVal || !enTimeVal) {
                alert("予約する時間が入力されていません");
            } else if (!reserVal) {
                alert("予約する日付が入力されていません");
            } else if (isReservableDate) {
                if (checkReservation(reservationData, parseTime(stTimeVal), parseTime(enTimeVal), parseDate(reserVal))) {
                    const reserDate = new Date(reserVal);
                    const formattedDate = `${reserDate.getFullYear()}年${reserDate.getMonth() + 1}月${reserDate.getDate()}日`;
                    if (confirm(`予約画面へ進みます\r\n${formattedDate}の${stTimeVal}～${enTimeVal}に${roomName}教室を予約しますか?`)) {
                        window.location.href = `info.php?room=${roomName}&time=${stTimeVal}~${enTimeVal}&date=${reserVal}`;
                    }
                } else {
                    alert("この時間はすでに予約されています");
                }
            } else {
                alert("3日後～2週間後までが予約可能です");
            }
        }
    }
}

