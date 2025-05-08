function checkReservation(reservationData, stTimeValue, enTimeValue, reservationDate) {
    if (!reservationData || reservationData.length === 0) {
        return true; // 予約データがない場合は利用可能
    }

    for (const reservation of reservationData) {
        const eachSplitedTimes = reservation.time.split("~");
        const eachStartTime = parseTime(eachSplitedTimes[0]);
        const eachEndTime = parseTime(eachSplitedTimes[1]);
        const eachReservationDate = parseDate(reservation.date);

        if (!(eachEndTime <= stTimeValue || enTimeValue <= eachStartTime) && eachReservationDate.getTime() === reservationDate.getTime()) {
            return false; // 予約時間帯が重複する場合は利用不可
        }
    }
    return true; // 予約時間帯が重複しない場合は利用可能
}

function checkAllReservationTimes(buildingNumber, maxFloor) {
    const stTimeValue = parseTime(document.getElementById("startTime").value);
    const enTimeValue = parseTime(document.getElementById("endTime").value);
    const reserValue = parseDate(document.getElementById("reservationDate").value);
    
    if (stTimeValue && enTimeValue && reserValue) {
        for (let floor = 1; floor <= maxFloor; floor++) {
            // SVG内の各クリッカブルな領域を取得し、状態を更新
            const svgElement = document.getElementById(`${buildingNumber}_${floor}F_SVG`);
            if (!svgElement) {
                continue; // 指定された階が存在しない場合は処理をスキップ
            }
            
            const areas = svgElement.querySelectorAll('[data-room]');

            areas.forEach(areaElement => {
                const roomNumber = areaElement.getAttribute("data-room");
                
                if (roomNumber in roomdata) {
                    const reservationData = roomdata[roomNumber];
                    if (areaElement.getAttribute('data-status') !== "-1") {
                        if (checkReservation(reservationData, stTimeValue, enTimeValue, reserValue)) {
                            areaElement.setAttribute('data-status', "1");
                        } else {
                            areaElement.setAttribute('data-status', "0");
                        }
                    }
                }
            });
        }
    }
}

