<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Russel's Case (Murder)</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            background: #0a0a0a;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #d4d4d4;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 2px,
                    rgba(255, 255, 255, 0.03) 2px,
                    rgba(255, 255, 255, 0.03) 4px
                );
            pointer-events: none;
            z-index: 1;
        }

        .container {
            max-width: 700px;
            width: 100%;
            background: linear-gradient(145deg, #1a1a1a 0%, #242424 100%);
            border: 4px solid #8b4513;
            box-shadow:
                0 20px 60px rgba(0,0,0,0.8),
                inset 0 1px 0 rgba(255,255,255,0.1),
                0 0 0 8px #0a0a0a;
            padding: 40px;
            position: relative;
            animation: fadeInUp 1s ease-out;
            z-index: 2;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .corner-decoration {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 3px solid #8b4513;
        }

        .corner-decoration.top-left {
            top: 15px;
            left: 15px;
            border-right: none;
            border-bottom: none;
        }

        .corner-decoration.top-right {
            top: 15px;
            right: 15px;
            border-left: none;
            border-bottom: none;
        }

        .corner-decoration.bottom-left {
            bottom: 15px;
            left: 15px;
            border-right: none;
            border-top: none;
        }

        .corner-decoration.bottom-right {
            bottom: 15px;
            right: 15px;
            border-left: none;
            border-top: none;
        }

        .stamp {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 100px;
            height: 100px;
            border: 4px solid #8b0000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-15deg);
            font-weight: bold;
            color: #8b0000;
            font-size: 11px;
            text-align: center;
            line-height: 1.3;
            background: radial-gradient(circle, rgba(139,0,0,0.1) 0%, transparent 70%);
            animation: stampDrop 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.5s both;
        }

        @keyframes stampDrop {
            from {
                transform: translateY(-100px) rotate(-15deg) scale(0);
                opacity: 0;
            }
            to {
                transform: translateY(0) rotate(-15deg) scale(1);
                opacity: 1;
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px double #8b4513;
            padding-bottom: 25px;
            position: relative;
        }

        h1 {
            color: #d4af37;
            font-size: 32px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            animation: titleGlow 2s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            from { text-shadow: 2px 2px 4px rgba(0,0,0,0.5), 0 0 10px rgba(212,175,55,0.3); }
            to { text-shadow: 2px 2px 4px rgba(0,0,0,0.5), 0 0 20px rgba(212,175,55,0.6); }
        }

        .case-number {
            color: #8b0000;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .instructions {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            padding: 20px;
            border-left: 5px solid #d4af37;
            margin-bottom: 30px;
            font-size: 14px;
            line-height: 1.8;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.5);
            animation: slideInLeft 0.8s ease-out 0.3s both;
            position: relative;
            overflow: hidden;
        }

        .instructions::before {
            content: '⚖';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 40px;
            opacity: 0.1;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .question-container {
            display: none;
            animation: questionEntrance 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .question-container.active {
            display: block;
        }

        @keyframes questionEntrance {
            from {
                opacity: 0;
                transform: perspective(1000px) rotateX(-15deg) translateY(30px);
            }
            to {
                opacity: 1;
                transform: perspective(1000px) rotateX(0) translateY(0);
            }
        }

        .question {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            padding: 25px;
            margin-bottom: 20px;
            border: 2px solid #8b4513;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            position: relative;
        }

        .question::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 48%, rgba(212,175,55,0.1) 50%, transparent 52%);
            pointer-events: none;
        }

        .question h3 {
            color: #d4af37;
            margin-bottom: 15px;
            font-size: 16px;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .question h3::before {
            content: '📋';
            font-size: 20px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .hint-box {
            background: #2a2a2a;
            padding: 20px;
            margin: 20px 0;
            border: 3px dashed #666;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hint-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212,175,55,0.2), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            to { left: 100%; }
        }

        .hint-box strong {
            color: #d4af37;
            display: block;
            margin-bottom: 15px;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .hint-image {
            width: 100%;
            max-width: 350px;
            height: 220px;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            margin: 10px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 14px;
            border: 2px solid #444;
            box-shadow: inset 0 4px 20px rgba(0,0,0,0.8);
            transition: all 0.8s ease;
        }

        /* IMAGE styling for hint images */
        .hint-image img {
            display: block;
            width: 100%;
            max-width: 350px;
            height: 220px;
            object-fit: cover;
            margin: 10px auto;
            border: 2px solid #444;
            box-shadow: inset 0 4px 20px rgba(0,0,0,0.8);
            transition: filter 1s ease, transform 1s ease, border-color 0.3s ease;
        }

        .revealed-image {
            filter: blur(15px) brightness(0.5);
            transition: filter 1s ease, transform 1s ease;
        }

        .revealed-image.clear {
            filter: blur(0) brightness(1);
            transform: scale(1.02);
            border-color: #d4af37;
        }

        input[type="text"] {
            width: 100%;
            padding: 15px;
            background: #0a0a0a;
            border: 2px solid #8b4513;
            color: #d4d4d4;
            font-family: 'Courier New', monospace;
            font-size: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.5);
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow:
                inset 0 2px 10px rgba(0,0,0,0.5),
                0 0 15px rgba(212,175,55,0.3);
            transform: translateY(-2px);
        }

        .btn {
            background: linear-gradient(135deg, #8b4513 0%, #a0522d 100%);
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(139,69,19,0.3);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(139,69,19,0.5);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .error {
            color: #ff4444;
            font-size: 13px;
            margin-top: 10px;
            display: none;
            padding: 10px;
            background: rgba(255,68,68,0.1);
            border-left: 3px solid #ff4444;
        }

        .error.show {
            display: block;
            animation: errorShake 0.6s cubic-bezier(.36,.07,.19,.97) both;
        }

        @keyframes errorShake {
            10%, 90% { transform: translateX(-2px); }
            20%, 80% { transform: translateX(4px); }
            30%, 50%, 70% { transform: translateX(-8px); }
            40%, 60% { transform: translateX(8px); }
        }

        .progress {
            background: #0a0a0a;
            height: 10px;
            margin-bottom: 25px;
            border: 2px solid #8b4513;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.8);
        }

        .progress-bar {
            background: linear-gradient(90deg, #8b4513, #d4af37, #8b4513);
            background-size: 200% 100%;
            height: 100%;
            width: 0%;
            transition: width 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            animation: progressGlow 2s linear infinite;
            box-shadow: 0 0 10px rgba(212,175,55,0.5);
        }

        @keyframes progressGlow {
            to { background-position: 200% 0; }
        }

        .final-reveal {
            display: none;
            text-align: center;
            animation: finalRevealAnim 1.2s ease-out;
        }

        .final-reveal.show {
            display: block;
        }

        @keyframes finalRevealAnim {
            from {
                opacity: 0;
                transform: scale(0.8) translateY(30px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .final-reveal h2 {
            color: #d4af37;
            margin-bottom: 20px;
            font-size: 28px;
            letter-spacing: 3px;
            animation: titlePulse 1.5s ease-in-out infinite;
        }

        @keyframes titlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .envelope-container {
            perspective: 1000px;
            margin: 40px auto;
        }

        .envelope {
            width: 280px;
            height: 180px;
            margin: 0 auto;
            cursor: pointer;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.5s ease;
            animation: envelopeFloat 3s ease-in-out infinite;
        }

        @keyframes envelopeFloat {
            0%, 100% { transform: translateY(0px) rotateZ(0deg); }
            50% { transform: translateY(-10px) rotateZ(2deg); }
        }

        .envelope:hover {
            transform: scale(1.1) rotateY(5deg);
            animation: none;
        }

        .envelope-back {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #c9a961 0%, #d4af37 50%, #c9a961 100%);
            border: 3px solid #8b4513;
            position: absolute;
            box-shadow: 0 15px 40px rgba(0,0,0,0.5);
        }

        .envelope-front {
            width: 100%;
            height: 100%;
            position: absolute;
            overflow: hidden;
        }

        .flap {
            width: 0;
            height: 0;
            border-left: 140px solid transparent;
            border-right: 140px solid transparent;
            border-top: 90px solid #b8941f;
            position: absolute;
            top: 0;
            left: 0;
            transform-origin: top center;
            transition: transform 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            z-index: 3;
        }

        .envelope.opening .flap {
            transform: rotateX(180deg);
        }

        .flap-fold {
            width: 0;
            height: 0;
            border-left: 140px solid transparent;
            border-right: 140px solid transparent;
            border-bottom: 90px solid #d4af37;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .envelope-seal {
            width: 50px;
            height: 50px;
            background: radial-gradient(circle, #8b0000 0%, #6b0000 100%);
            border-radius: 50%;
            position: absolute;
            top: 85px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d4af37;
            font-weight: bold;
            font-size: 20px;
            box-shadow: 0 5px 15px rgba(139,0,0,0.5);
            border: 2px solid #d4af37;
            transition: all 0.3s ease;
        }

        .envelope:hover .envelope-seal {
            transform: translateX(-50%) scale(1.1) rotate(5deg);
        }

        .envelope-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: envelopeShine 3s infinite;
        }

        @keyframes envelopeShine {
            to { left: 100%; }
        }

        .click-hint {
            margin-top: 20px;
            color: #d4af37;
            font-size: 14px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .letter {
            display: none;
            background: linear-gradient(to bottom, #f9f5e8 0%, #f4f0e0 100%);
            color: #1a1a1a;
            padding: 40px;
            margin-top: 30px;
            border: 3px solid #8b4513;
            box-shadow: 0 15px 50px rgba(0,0,0,0.5);
            animation: letterUnfold 1s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            text-align: left;
            position: relative;
            overflow: hidden;
        }

        .letter::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 25px,
                    rgba(139,69,19,0.1) 25px,
                    rgba(139,69,19,0.1) 26px
                );
            pointer-events: none;
        }

        .letter.show {
            display: block;
        }

        @keyframes letterUnfold {
            0% {
                opacity: 0;
                transform: perspective(1000px) rotateX(-90deg) translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: perspective(1000px) rotateX(0) translateY(0);
            }
        }

        .letter h3 {
            text-align: center;
            color: #8b0000;
            margin-bottom: 25px;
            font-size: 22px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-bottom: 2px solid #8b0000;
            padding-bottom: 15px;
        }

        .suspect-name {
            color: #8b0000;
            font-weight: bold;
            font-size: 20px;
            margin: 25px 0;
            text-align: center;
            animation: suspectReveal 1s ease-out 0.5s both;
        }

        @keyframes suspectReveal {
            from {
                opacity: 0;
                letter-spacing: 10px;
            }
            to {
                opacity: 1;
                letter-spacing: 2px;
            }
        }

        .love-message {
            line-height: 2;
            margin-top: 25px;
            font-style: italic;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .container {
                padding: 25px;
            }

            h1 {
                font-size: 24px;
            }

            .stamp {
                width: 80px;
                height: 80px;
                font-size: 10px;
                top: 20px;
                right: 20px;
            }

            .envelope {
                width: 200px;
                height: 130px;
            }

            .flap {
                border-left: 100px solid transparent;
                border-right: 100px solid transparent;
                border-top: 65px solid #b8941f;
            }

            .flap-fold {
                border-left: 100px solid transparent;
                border-right: 100px solid transparent;
                border-bottom: 65px solid #d4af37;
            }

            .envelope-seal {
                width: 40px;
                height: 40px;
                font-size: 16px;
                top: 60px;
            }

            .letter {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="corner-decoration top-left"></div>
        <div class="corner-decoration top-right"></div>
        <div class="corner-decoration bottom-left"></div>
        <div class="corner-decoration bottom-right"></div>

        <div class="stamp">CONFIDENTIAL<br>CASE FILE<br>⚖️</div>

        <div class="header">
            <h1>Russel's Case (Murder)</h1>
            <p class="case-number">CASE NO. 2025-LOVE-001</p>
        </div>

        <div class="progress">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <div class="instructions" id="instructions">
            <strong>⚖️ CASE INSTRUCTIONS:</strong><br>
            You need to find the correct answer to each question (5 questions total) to identify the suspect in Russel's Case. Each correct answer will reveal crucial evidence. Proceed with caution, detective.
        </div>

        <!-- Question 1 -->
        <div class="question-container active" id="q1">
            <div class="question">
                <h3>QUESTION 1 OF 5</h3>
                <p>What is the full name of Russel's Wife?</p>
                <div class="hint-box">
                    <strong>EVIDENCE A:</strong>
                    <div class="hint-image">
                        <img id="hint1" class="revealed-image" src="hint1.jpg" alt="Photo Evidence A" onerror="this.style.display='none'">
                    </div>
                </div>
                <input type="text" id="answer1" placeholder="Enter full name...">
                <button class="btn" onclick="checkAnswer(1)">Submit Answer</button>
                <p class="error" id="error1">❌ Incorrect. Re-check the evidence and try again.</p>
            </div>
        </div>

        <!-- Question 2 -->
        <div class="question-container" id="q2">
            <div class="question">
                <h3>QUESTION 2 OF 5</h3>
                <p>When did Russel and Patrick first meet?</p>
                <div class="hint-box">
                    <strong>EVIDENCE B:</strong>
                    <div class="hint-image">
                        <img id="hint2" class="revealed-image" src="hint2.jpg" alt="Date Evidence" onerror="this.style.display='none'">
                    </div>
                </div>
                <input type="text" id="answer2" placeholder="Enter date (MM/DD/YY or Month Day, Year)...">
                <button class="btn" onclick="checkAnswer(2)">Submit Answer</button>
                <p class="error" id="error2">❌ Incorrect. Re-check the evidence and try again.</p>
            </div>
        </div>

        <!-- Question 3 -->
        <div class="question-container" id="q3">
            <div class="question">
                <h3>QUESTION 3 OF 5</h3>
                <p>Where was the first meeting of Russel and Patrick?</p>
                <div class="hint-box">
                    <strong>EVIDENCE C:</strong>
                    <div class="hint-image">
                        <img id="hint3" class="revealed-image" src="hint3.jpg" alt="Location Evidence" onerror="this.style.display='none'">
                    </div>
                </div>
                <input type="text" id="answer3" placeholder="Enter location...">
                <button class="btn" onclick="checkAnswer(3)">Submit Answer</button>
                <p class="error" id="error3">❌ Incorrect. Re-check the evidence and try again.</p>
            </div>
        </div>

        <!-- Question 4 -->
        <div class="question-container" id="q4">
            <div class="question">
                <h3>QUESTION 4 OF 5</h3>
                <p>When is your husband's birthday?</p>
                <div class="hint-box">
                    <strong>EVIDENCE D:</strong>
                    <div class="hint-image">
                        <img id="hint4" class="revealed-image" src="hint4.png" alt="Birth Certificate Evidence" onerror="this.style.display='none'">
                    </div>
                </div>
                <input type="text" id="answer4" placeholder="Enter date (MM/DD/YY or Month Day, Year)...">
                <button class="btn" onclick="checkAnswer(4)">Submit Answer</button>
                <p class="error" id="error4">❌ Incorrect. Re-check the evidence and try again.</p>
            </div>
        </div>

        <!-- Question 5 -->
        <div class="question-container" id="q5">
            <div class="question">
                <h3>QUESTION 5 OF 5</h3>
                <p>What is your husband's full name?</p>
                <div class="hint-box">
                    <strong>EVIDENCE E:</strong>
                    <div class="hint-image">
                        <img id="hint5" class="revealed-image" src="hint5.jpg" alt="Identity Evidence" onerror="this.style.display='none'">
                    </div>
                </div>
                <input type="text" id="answer5" placeholder="Enter full name...">
                <button class="btn" onclick="checkAnswer(5)">Submit Answer</button>
                <p class="error" id="error5">❌ Incorrect. Re-check the evidence and try again.</p>
            </div>
        </div>

        <!-- Final Reveal -->
        <div class="final-reveal" id="finalReveal">
            <h2>🔒 CASE CLOSED 🔒</h2>
            <p style="margin-bottom: 20px; font-size: 16px;">Congratulations, Detective! You've identified the suspect in Russel's Case.</p>

            <div class="envelope-container">
                <div class="envelope" id="envelope" onclick="openEnvelope()">
                    <div class="envelope-back">
                        <div class="envelope-shine"></div>
                    </div>
                    <div class="envelope-front">
                        <div class="flap"></div>
                        <div class="flap-fold"></div>
                        <div class="envelope-seal">❤️</div>
                    </div>
                </div>
            </div>

            <p class="click-hint">👆 Click the envelope to reveal the truth</p>

            <div class="letter" id="letter">
                <h3>🔍 SUSPECT IDENTIFIED 🔍</h3>
                <p class="suspect-name">JOHN PATRICK MASOLA FLORES</p>
                <p style="text-align: center; margin-bottom: 20px; font-weight: bold;">is the suspect. She stole the heart of Russel James Fernandez.</p>
                <p style="text-align: center; margin-bottom: 30px; color: #8b0000; font-size: 18px; font-weight: bold;">Kaya patay na patay si Russel kay Patrick. ❤️</p>

                <div style="border-top: 3px double #8b4513; padding-top: 25px;">
                    <p class="love-message">
                        "Hi misis ko. I love you so much, mahal na mahal na mahal kita palagi, handa akong ipaglaban ka hanggang sa kamatayan ko. Sabay nating tutuparin ang bawat pangarap at pagsubok na ibibigay sa atin ng mundo, tadhana at panahon. Palagi kitang mahal misis ko. Happy 3rd monthsary. I love you so much"
                    </p>
                    <p style="text-align: right; margin-top: 20px; font-weight: bold; color: #8b4513;">- Your Russel 💕</p>
                </div>
            </div>
        </div>
    </div>

    <audio id="bgMusic" loop>
        <source src="years.mp3" type="audio/mpeg">
    </audio>

    <script>
        const answers = {
            1: ['john patrick masola flores'],
            2: ['july 29, 2025', '07/29/25', '7/29/25', '29 july 2025', 'july 29 2025'],
            3: ['roxas airport', 'airport', 'roxas city'],
            4: ['september 27, 2003', '09/27/03', '9/27/03', '27 september 2003', 'september 27 2003'],
            5: ['russel james pablo fernandez']
        };

        let currentQuestion = 1;
        const totalQuestions = 5;

        function normalizeAnswer(answer) {
            return answer.toLowerCase().trim().replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g, '').replace(/\s+/g, ' ');
        }

        function checkAnswer(questionNum) {
            const input = document.getElementById(`answer${questionNum}`);
            const error = document.getElementById(`error${questionNum}`);
            const userAnswer = normalizeAnswer(input.value);

            const correctAnswers = answers[questionNum].map(a => normalizeAnswer(a));
            const isCorrect = correctAnswers.includes(userAnswer);

            if (isCorrect) {
                error.classList.remove('show');

                // Clear the hint image with animation
                const hintImg = document.getElementById(`hint${questionNum}`);
                if (hintImg) {
                    hintImg.classList.add('clear');
                }

                // Disable input and button
                input.disabled = true;
                input.style.borderColor = '#4CAF50';

                // Move to next question or show final reveal
                setTimeout(() => {
                    document.getElementById(`q${questionNum}`).classList.remove('active');

                    if (questionNum < totalQuestions) {
                        currentQuestion++;
                        document.getElementById(`q${currentQuestion}`).classList.add('active');
                        updateProgress();
                    } else {
                        // Show final reveal
                        currentQuestion = totalQuestions;
                        updateProgress();
                        setTimeout(() => {
                            document.getElementById('finalReveal').classList.add('show');
                        }, 800);
                    }
                }, 1000);
            } else {
                error.classList.add('show');
                input.style.borderColor = '#ff4444';

                // Shake the input
                input.style.animation = 'none';
                setTimeout(() => {
                    input.style.animation = 'errorShake 0.6s cubic-bezier(.36,.07,.19,.97)';
                }, 10);

                setTimeout(() => {
                    input.style.borderColor = '#8b4513';
                }, 1500);
            }
        }

        function updateProgress() {
            const progress = (currentQuestion / totalQuestions) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
        }

        function openEnvelope() {
            const envelope = document.getElementById('envelope');
            const letter = document.getElementById('letter');
            const music = document.getElementById('bgMusic');
            const clickHint = document.querySelector('.click-hint');

            if (envelope.classList.contains('opening')) return;

            envelope.classList.add('opening');
            envelope.style.cursor = 'default';
            envelope.style.animation = 'none';

            if (clickHint) {
                clickHint.style.display = 'none';
            }

            setTimeout(() => {
                letter.classList.add('show');
                music.play().catch(e => console.log('Audio play failed:', e));
            }, 800);
        }

        // Allow Enter key to submit
        document.querySelectorAll('input[type="text"]').forEach((input, index) => {
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && !input.disabled) {
                    checkAnswer(index + 1);
                }
            });
        });

        // Initialize progress
        updateProgress();
    </script>
</body>
</html>
