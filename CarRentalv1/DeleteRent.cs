using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace CarRentalv1
{
    public partial class DeleteRent : Form
    {
        private VehicleRentalManagement _data = null;
        public DeleteRent(VehicleRentalManagement vehicleRentalManagementModel)
        {
            this._data = vehicleRentalManagementModel;
            InitializeComponent();
        }
        private void DeleteRent_Load(object sender, EventArgs e)
        {

        }

        private void DeleteButton_Click(object sender, EventArgs e)
        {
            int rentId = -1;

            try
            {
                rentId = int.Parse(RentIDTextBox.Text);
            }
            catch
            {
                MessageBox.Show("Option must be interger");
                return;
            }

            if (!_data.DeleteRent(rentId))
            {
                MessageBox.Show("Vehicle doesn't existed");
            }
            else
            {
                MessageBox.Show("Rent has been successfully deleted!");
            }
        }
    }
}
