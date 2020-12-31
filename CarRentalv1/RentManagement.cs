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
    public partial class RentManagement : Form
    {
        private VehicleRentalManagement _data = null;
        public RentManagement(VehicleRentalManagement vehicleRentalManagementModel)
        {
            this._data = vehicleRentalManagementModel;
            InitializeComponent();
            IntroText.Font = new Font("Arial", 24, FontStyle.Bold);
        }

        private void AddRentButton_Click(object sender, EventArgs e)
        {
            AddRentForm bookAndRentForm = new AddRentForm(_data);
            bookAndRentForm.Show();
        }

        private void ViewAllRentButton_Click(object sender, EventArgs e)
        {
            ViewAllRents viewAllRents = new ViewAllRents(_data);
            viewAllRents.Show();
        }

        private void UpdateRentButton_Click(object sender, EventArgs e)
        {
            UpdateRent updateRent = new UpdateRent(_data);
            updateRent.Show();
        }

        private void DeleteRentButton_Click(object sender, EventArgs e)
        {
            DeleteRent deleteRent = new DeleteRent(_data);
            deleteRent.Show();
        }

        private void IntroText_Click(object sender, EventArgs e)
        {

        }

        private void RentManagement_Load(object sender, EventArgs e)
        {

        }
    }
}
