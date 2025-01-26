const express = require('express');
const mongoose = require('mongoose');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Middleware
app.use(bodyParser.json());

// Kết nối tới MongoDB
mongoose.connect('mongodb://localhost:27017/userdb', { useNewUrlParser: true, useUnifiedTopology: true })
    .then(() => console.log("Connected to MongoDB"))
    .catch(err => console.log(err));

// Định nghĩa model cho người dùng
const User = mongoose.model('User', new mongoose.Schema({
    username: { type: String, required: true, unique: true },
    password: { type: String, required: true }
}));

// Đăng ký người dùng
app.post('/api/signup', async (req, res) => {
    const { username, password } = req.body;

    // Kiểm tra xem người dùng đã tồn tại chưa
    const existingUser = await User.findOne({ username });
    if (existingUser) {
        return res.status(400).json({ message: 'Tên đăng nhập đã tồn tại' });
    }

    // Mã hóa mật khẩu
    const hashedPassword = await bcrypt.hash(password, 10);

    const user = new User({ username, password: hashedPassword });

    await user.save();

    res.status(201).json({ message: 'Đăng ký thành công' });
});

// Đăng nhập người dùng
app.post('/api/login', async (req, res) => {
    const { username, password } = req.body;

    const user = await User.findOne({ username });
    if (!user) {
        return res.status(400).json({ message: 'Tên đăng nhập không đúng' });
    }

    const isMatch = await bcrypt.compare(password, user.password);
    if (!isMatch) {
        return res.status(400).json({ message: 'Mật khẩu không đúng' });
    }

    // Tạo token JWT
    const token = jwt.sign({ userId: user._id }, 'secretkey', { expiresIn: '1h' });

    res.json({ message: 'Đăng nhập thành công', token });
});

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
