
import java.io.File;
import java.io.FileNotFoundException;
import java.io.PrintWriter;
import java.util.Scanner;

/**
 * A program to switch the csv file into sql file.
 *
 * @author Yilong Wu(A00429725)
 */
public class authorscsv_to_sql {

    public static void main(String[] args) throws FileNotFoundException {
        File file = new File("./authors.csv");
        Scanner fin = new Scanner(file);
        PrintWriter fout = new PrintWriter(new File("insert_authors.sql"));

        // output the first part of the sql file command
        fin.nextLine();

        // read the data from the csv.file
        while (fin.hasNext()) {
            String temp1 = fin.nextLine();
            String[] temp = temp1.split(",");

            // change format
            for (int i = 0; i < temp.length - 1; ++i) {
                temp[i] = temp[i].replace("\"\"", "\"");
            }

            // output the result
            fout.print("insert into AUTHOR(_id, lname, fname,email) values");
            fout.println("('" + temp[0] + "','" + temp[1] + "','" + temp[2]
                    + "','" + temp[3] + "');");

        }
        fin.close();
        fout.close();

    }

};
