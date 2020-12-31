using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.IO;

namespace CarRentalv1
{
    public partial class DisplayServiceHistory : Form
    {
        public DisplayServiceHistory()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {

            try
            {
                string saveRecord = File.ReadAllText(CarID.Text + ".json");
                Display.Text = saveRecord;
            }
            catch
            {
                MessageBox.Show("ID car isn't found!!");
                CarID.Text = string.Empty;
                Display.Text = string.Empty;
            }


        }

        private void button2_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}
