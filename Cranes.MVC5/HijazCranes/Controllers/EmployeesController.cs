using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.IO;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using HijazCranes.Models;

namespace HijazCranes.Controllers
{
    public class EmployeesController : Controller
    {
        private ApplicationDbContext _context;
        public EmployeesController()
        {
            _context = new ApplicationDbContext();
        }

        protected override void Dispose(bool disposing)
        {
            _context.Dispose();
        }

        // GET: Employees
        public ActionResult Index()
        {
            return View(_context.Employees.ToList());
        }

        // GET: Employees/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Employee employee = _context.Employees.Find(id);
            if (employee == null)
            {
                return HttpNotFound();
            }
            return View(employee);
        }

        // GET: Employees/Create
        public ActionResult Create()
        {
            return View();
        }

        // GET: Employees/Edit/5
        public ActionResult Edit(int id)
        {
            var employee = _context.Employees.SingleOrDefault(c => c.Id == id);
            if (employee == null)
            {
                return HttpNotFound();
            }
            return View(employee);
        }

        // POST: Employees/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Save(Employee employee)
        {
            if (ModelState.IsValid)
            {
                if (employee.Id == 0)
                {
                    if (employee.ImageFile != null)
                    {
                        var fileName = Path.GetFileNameWithoutExtension(employee.ImageFile.FileName);
                        var exe = Path.GetExtension(employee.ImageFile.FileName);
                        fileName = employee.Id + DateTime.Now.ToString("yymmssff") + exe;
                        employee.Image = "~/Images/Employees/" + fileName;
                        // Copy 
                        fileName = Path.Combine(Server.MapPath("~/Images/Employees/"), fileName);
                        employee.ImageFile.SaveAs(fileName);
                    }
                    _context.Employees.Add(employee);
                }
                else
                {
                    var employeeInDb = _context.Employees.SingleOrDefault(c => c.Id == employee.Id);
                    employeeInDb.FirstName = employee.FirstName;
                    employeeInDb.MiddleName = employee.MiddleName;
                    employeeInDb.LastName = employee.LastName;
                    employeeInDb.Position = employee.Position;
                    employeeInDb.Salary = employee.Salary;
                    if (employee.ImageFile != null)
                    {
                        // Delete Image
                        var path = Server.MapPath(employeeInDb.Image);
                        var fileToBeDelete = new FileInfo(path);
                        if (fileToBeDelete.Exists)
                        {
                            fileToBeDelete.Delete();
                        }

                        var fileName = Path.GetFileNameWithoutExtension(employee.ImageFile.FileName);
                        var exe = Path.GetExtension(employee.ImageFile.FileName);
                        fileName = employee.Id + DateTime.Now.ToString("yymmssff") + exe;
                        employeeInDb.Image = "~/Images/Employees/" + fileName;
                        // Copy 
                        fileName = Path.Combine(Server.MapPath("~/Images/Employees/"), fileName);
                        employee.ImageFile.SaveAs(fileName);
                    }
                }
                _context.SaveChanges();
                return RedirectToAction("Index");
            }
            else
            {
                return RedirectToAction("Edit", employee);
            }
        }

        // GET: Employees/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Employee employee = _context.Employees.Find(id);
            if (employee == null)
            {
                return HttpNotFound();
            }
            return View(employee);
        }

        // POST: Employees/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Employee employee = _context.Employees.Find(id);
            var path = Server.MapPath(employee.Image);
            var fileToBeDelete = new FileInfo(path);
            if (fileToBeDelete.Exists)
            {
                fileToBeDelete.Delete();
            }
            _context.Employees.Remove(employee);
            _context.SaveChanges();
            return RedirectToAction("Index");
        }
    }
}
