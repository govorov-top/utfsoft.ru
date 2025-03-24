import swal from "sweetalert";

export function vhodGame() {
    const cells = document.querySelectorAll("[data-cell]");
    const board = document.getElementById("game-board");
    const timerElement = document.getElementById("time");

    const X_CLASS = "x";
    const O_CLASS = "o";
    const WINNING_COMBINATIONS = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6],
    ];

    let circleTurn;
    let isBoardLocked = false;
    let countdown;
    let isTimerExpired = false;

    // Запускаем игру
    startGame();
    // Запускаем таймер отдельно от игры
    startTimer();

    function startGame() {
        circleTurn = false;
        isBoardLocked = false;
        cells.forEach(cell => {
            cell.classList.remove(X_CLASS);
            cell.classList.remove(O_CLASS);
            cell.textContent = ""; // Clear cell content
            cell.removeEventListener("click", handleClick);
            cell.addEventListener("click", handleClick, { once: true });
        });
        setBoardHoverClass();
    }

    function handleClick(e) {
        if (isBoardLocked) return; // Prevent user from clicking when board is locked
        const cell = e.target;
        if (cell.classList.contains(X_CLASS) || cell.classList.contains(O_CLASS)) return; // Prevent clicking on occupied cells
        const currentClass = X_CLASS;
        placeMark(cell, currentClass);
        if (checkWin(currentClass)) {
            endGame(false, true); // Пользователь выиграл
        } else if (isDraw()) {
            endGame(true, false); // Ничья
        } else {
            swapTurns();
            setBoardHoverClass();
            isBoardLocked = true; // Lock the board for computer's move
            setTimeout(computerMove, 500); // Delay for computer move
        }
    }

    function placeMark(cell, currentClass) {
        cell.classList.add(currentClass);
        cell.textContent = currentClass.toUpperCase(); // Add text content to cell
    }

    function swapTurns() {
        circleTurn = !circleTurn;
    }

    function setBoardHoverClass() {
        board.classList.remove(X_CLASS);
        board.classList.remove(O_CLASS);
        if (circleTurn) {
            board.classList.add(O_CLASS);
        } else {
            board.classList.add(X_CLASS);
        }
    }

    function checkWin(currentClass) {
        return WINNING_COMBINATIONS.some(combination => {
            return combination.every(index => {
                return cells[index].classList.contains(currentClass);
            });
        });
    }

    function isDraw() {
        return [...cells].every(cell => {
            return cell.classList.contains(X_CLASS) || cell.classList.contains(O_CLASS);
        });
    }

    function endGame(draw, userWon) {
        let message = "";
        if (draw) {
            message = "Ничья!";
        } else {
            message = `${circleTurn ? "Компьютер победил" : "Вы победили"}!`;
        }
        swal({
            title: message,
            icon: `${circleTurn ? "error" : "success"}`,
            buttons: {
                restart: {
                    text: "Начать сначала!",
                    value: "restart",
                },
            },
        }).then(value => {
            if (value === "restart") {
                startGame(); // Запускаем только игру без таймера
            }
        });

        if (userWon) {
            clearInterval(countdown);
            timerElement.innerHTML = '<a class="btn" target="_blank" href="https://kontur.ru/?utm_sorce=3">Вход</a>';
            isTimerExpired = true; // Mark the timer as expired
        }

        isBoardLocked = true; // Lock the board when game ends
    }

    function startTimer() {
        let time = 120;
        countdown = setInterval(() => {
            time--;
            let minutes = Math.floor(time / 60);
            let seconds = time % 60;
            timerElement.textContent = `${minutes < 10 ? "0" : ""}${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
            if (time <= 0) {
                clearInterval(countdown);
                timerElement.innerHTML = '<a class="btn" target="_blank" href="https://kontur.ru?utm_sorce=3">Вход</a>';
                isTimerExpired = true; // Mark the timer as expired
            }
        }, 1000);
    }

    function computerMove() {
        const bestMove = minimax([...cells], O_CLASS).index;
        const cell = cells[bestMove];
        placeMark(cell, O_CLASS);
        if (checkWin(O_CLASS)) {
            endGame(false, false); // Компьютер выиграл
        } else if (isDraw()) {
            endGame(true, false); // Ничья
        } else {
            swapTurns();
            setBoardHoverClass();
            isBoardLocked = false; // Unlock the board for player's move
            cells.forEach(cell => {
                cell.removeEventListener("click", handleClick);
                cell.addEventListener("click", handleClick, { once: true });
            });
        }
    }

    function minimax(newBoard, player) {
        const availSpots = getEmptyCells(newBoard);

        if (checkWin(X_CLASS)) {
            return { score: -10 };
        } else if (checkWin(O_CLASS)) {
            return { score: 10 };
        } else if (availSpots.length === 0) {
            return { score: 0 };
        }

        const moves = [];
        for (let i = 0; i < availSpots.length; i++) {
            const move = {};
            move.index = availSpots[i];

            newBoard[availSpots[i]].classList.add(player);

            if (player === O_CLASS) {
                const result = minimax(newBoard, X_CLASS);
                move.score = result.score;
            } else {
                const result = minimax(newBoard, O_CLASS);
                move.score = result.score;
            }

            newBoard[availSpots[i]].classList.remove(player);
            moves.push(move);
        }

        let bestMove;
        if (player === O_CLASS) {
            let bestScore = -10000;
            for (let i = 0; i < moves.length; i++) {
                if (moves[i].score > bestScore) {
                    bestScore = moves[i].score;
                    bestMove = i;
                }
            }
        } else {
            let bestScore = 10000;
            for (let i = 0; i < moves.length; i++) {
                if (moves[i].score < bestScore) {
                    bestScore = moves[i].score;
                    bestMove = i;
                }
            }
        }

        return moves[bestMove];
    }

    function getEmptyCells(board) {
        return board
            .map((cell, index) => {
                if (!cell.classList.contains(X_CLASS) && !cell.classList.contains(O_CLASS)) {
                    return index;
                }
            })
            .filter(index => index !== undefined);
    }
}
