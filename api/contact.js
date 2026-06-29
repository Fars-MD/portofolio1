export default async function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).json({ message: 'Method not allowed' })
  }

  const { name, email, subject, message } = req.body

  if (!name || !email || !subject || !message) {
    return res.status(400).json({ message: 'All fields are required' })
  }

  return res.status(200).json({
    message: 'Pesan berhasil dikirim. Terima kasih!',
    data: { name, email, subject, message },
  })
}
