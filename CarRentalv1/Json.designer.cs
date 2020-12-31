
namespace CarRentalv1
{
    partial class Json
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.label1 = new System.Windows.Forms.Label();
            this.AddAndSave = new System.Windows.Forms.Button();
            this.Display = new System.Windows.Forms.Button();
            this.Exit = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.BackColor = System.Drawing.SystemColors.ControlDark;
            this.label1.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.label1.Location = new System.Drawing.Point(292, 61);
            this.label1.Name = "label1";
            this.label1.RightToLeft = System.Windows.Forms.RightToLeft.No;
            this.label1.Size = new System.Drawing.Size(176, 17);
            this.label1.TabIndex = 0;
            this.label1.Text = "Please choose your option";
            this.label1.Click += new System.EventHandler(this.label1_Click);
            // 
            // AddAndSave
            // 
            this.AddAndSave.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.AddAndSave.Location = new System.Drawing.Point(69, 145);
            this.AddAndSave.Name = "AddAndSave";
            this.AddAndSave.Size = new System.Drawing.Size(255, 131);
            this.AddAndSave.TabIndex = 1;
            this.AddAndSave.Text = "Add and Save service for a car";
            this.AddAndSave.UseVisualStyleBackColor = true;
            this.AddAndSave.Click += new System.EventHandler(this.button1_Click);
            // 
            // Display
            // 
            this.Display.FlatStyle = System.Windows.Forms.FlatStyle.Popup;
            this.Display.Location = new System.Drawing.Point(426, 145);
            this.Display.Name = "Display";
            this.Display.Size = new System.Drawing.Size(283, 131);
            this.Display.TabIndex = 2;
            this.Display.Text = "Display service history of a car";
            this.Display.UseVisualStyleBackColor = true;
            this.Display.Click += new System.EventHandler(this.button2_Click);
            // 
            // Exit
            // 
            this.Exit.Location = new System.Drawing.Point(333, 353);
            this.Exit.Name = "Exit";
            this.Exit.Size = new System.Drawing.Size(75, 23);
            this.Exit.TabIndex = 3;
            this.Exit.Text = "Exit";
            this.Exit.UseVisualStyleBackColor = true;
            this.Exit.Click += new System.EventHandler(this.Exit_Click);
            // 
            // Json
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(800, 450);
            this.Controls.Add(this.Exit);
            this.Controls.Add(this.Display);
            this.Controls.Add(this.AddAndSave);
            this.Controls.Add(this.label1);
            this.Name = "Json";
            this.Text = "Save - Display service";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button AddAndSave;
        private System.Windows.Forms.Button Display;
        private System.Windows.Forms.Button Exit;
    }
}

